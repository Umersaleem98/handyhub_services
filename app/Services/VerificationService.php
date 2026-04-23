<?php

namespace App\Services;

use App\Models\User;
use App\Models\VerificationDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VerificationService
{
    public function uploadDocument(User $user, string $type, $file): VerificationDocument
    {
        $allowedTypes = [
            'cnic_front', 'cnic_back', 'professional_license',
            'police_clearance', 'utility_bill', 'profile_photo', 'work_sample_photo'
        ];

        if (!in_array($type, $allowedTypes)) {
            throw new \InvalidArgumentException('Invalid document type');
        }

        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = "verifications/{$user->id}/{$type}/{$fileName}";

        Storage::disk('public')->putFileAs(
            dirname($path),
            $file,
            basename($path)
        );

        $fileHash = hash_file('sha256', $file->getRealPath());

        return VerificationDocument::create([
            'user_id' => $user->id,
            'document_type' => $type,
            'file_path' => $path,
            'file_original_name' => $file->getClientOriginalName(),
            'file_hash' => $fileHash,
            'status' => 'pending',
        ]);
    }
}