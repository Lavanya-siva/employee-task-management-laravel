<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // View uploaded documents
    public function viewDocuments(Request $request)
    {
        $user = $request->user('sanctum');

        if (!in_array($user->registration_status, ['personal_info', 'documents_uploaded', 'documents_reuploaded'])) {
            return response()->json([
                'success' => false,
                'message' => 'Documents cannot be viewed at this stage.'
            ], 403);
        }

        $documents = Document::where('users_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $documents
        ]);
    }

    // Upload two documents at a time
    public function upload(Request $request)
    {
        
        $user = $request->user('sanctum');

        if ($user->registration_status !== 'personal_info') {
            return response()->json([
                'success' => false,
                'message' => 'Document upload not allowed at this stage.'
            ], 403);
        }
       
        // Validate two files
        $request->validate([
            'id_proof_name' => 'required|string|max:30',
            'id_proof_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'kra_pin_name' => 'required|string|max:30',
            'kra_pin_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $filesToUpload = [
            ['category' => 'ID Proof', 'name' => $request->id_proof_name, 'file' => $request->file('id_proof_file')],
            ['category' => 'KRA Pin', 'name' => $request->kra_pin_name, 'file' => $request->file('kra_pin_file')],
        ];

        $uploadedDocs = [];

        foreach ($filesToUpload as $fileData) {
            // Check for existing doc
            $existingDoc = Document::where('users_id', $user->id)
                                   ->where('document_category', $fileData['category'])
                                   ->first();

            $file = $fileData['file'];
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            if ($existingDoc) {
                // Replace existing file
                if (Storage::disk('public')->exists($existingDoc->file_path)) {
                    Storage::disk('public')->delete($existingDoc->file_path);
                }
                $existingDoc->update([
                    'document_name' => $fileData['name'],
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath,
                    'current_status' => 'pending',
                    'uploaded_at' => now(),
                ]);
                $uploadedDocs[] = $existingDoc;
            } else {
                // Create new
                $doc = Document::create([
                    'users_id' => $user->id,
                    'document_category' => $fileData['category'],
                    'document_name' => $fileData['name'],
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath,
                    'current_status' => 'pending',
                    'uploaded_at' => now(),
                ]);
                $uploadedDocs[] = $doc;
            }
        }

        // Update user status
        $user->registration_status = 'documents_uploaded';
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Documents uploaded successfully',
            'data' => $uploadedDocs
        ]);
    }

    // Re-upload two documents at a time
    public function reupload(Request $request)
    {
        $user = $request->user('sanctum');

        if (!in_array($user->registration_status, ['personal_info', 'documents_uploaded', 'documents_reuploaded'])) {
            return response()->json([
                'success' => false,
                'message' => 'Re-upload not allowed at this stage.'
            ], 403);
        }

        // Same validation as upload
        $request->validate([
            'id_proof_name' => 'required|string|max:30',
            'id_proof_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'kra_pin_name' => 'required|string|max:30',
            'kra_pin_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $filesToUpload = [
            ['category' => 'ID Proof', 'name' => $request->id_proof_name, 'file' => $request->file('id_proof_file')],
            ['category' => 'KRA Pin', 'name' => $request->kra_pin_name, 'file' => $request->file('kra_pin_file')],
        ];

        $uploadedDocs = [];

        foreach ($filesToUpload as $fileData) {
            $existingDoc = Document::where('users_id', $user->id)
                                   ->where('document_category', $fileData['category'])
                                   ->first();

            $file = $fileData['file'];
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'private');

            if ($existingDoc) {
                if (Storage::disk('private')->exists($existingDoc->file_path)) {
                    Storage::disk('private')->delete($existingDoc->file_path);
                }
                $existingDoc->update([
                    'document_name' => $fileData['name'],
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath,
                    'current_status' => 'pending',
                    'uploaded_at' => now(),
                ]);
                $uploadedDocs[] = $existingDoc;
            } else {
                $doc = Document::create([
                    'users_id' => $user->id,
                    'document_category' => $fileData['category'],
                    'document_name' => $fileData['name'],
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath,
                    'current_status' => 'pending',
                    'uploaded_at' => now(),
                ]);
                $uploadedDocs[] = $doc;
            }
        }

        $user->registration_status = 'documents_reuploaded';
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Documents re-uploaded successfully',
            'data' => $uploadedDocs
        ]);
    }
}
