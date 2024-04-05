<?php

namespace App\Http\Controllers\Api;

use ImageKit\ImageKit;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomOrderNotification;

class CustomOrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'image' => 'nullable|max:2048',
            'link' => 'nullable|url',
        ]);

        $customOrder = new CustomOrder();
        $customOrder->full_name = $request->full_name;
        $customOrder->email = $request->email;
        $customOrder->message = $request->message;


        $imageKit = new ImageKit(
            "public_yHkkydctuDLQxoy5zFiseD9ZiW0=",

            "private_yPLFIGZ49woAFKkKT8eyt2yriCE=",
            "https://ik.imagekit.io/hx2cyuc3r"
        );

        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        $file = $imageKit->uploadFile([
            'file' => 'data:' . $fileType . ';base64,' . base64_encode(file_get_contents($_FILES['image']['tmp_name'])),
            'fileName' => 'picture',
        ]);
        $customOrder->image = $file->result->url;
        $customOrder->link = $request->link;
        $customOrder->save();

        Mail::to('admin@example.com')->send(new CustomOrderNotification($customOrder));

        if ($customOrder) {
            return response()->json([
                'success' => true,
                'message' => 'Custom order created successfully',
                'data' => $customOrder
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }
}
