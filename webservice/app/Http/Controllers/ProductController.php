<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    

public function index()
{
    return ProductResource::collection(Product::all());
}

public function store(Request $request)
{
    try {
        // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // สร้างสินค้าใหม่
        $product = Product::create($validatedData);

        // ส่งการตอบกลับ JSON พร้อมข้อมูลสินค้าใหม่
        return response()->json($product, 201);

    } catch (\Exception $e) {
        // บันทึกข้อผิดพลาดลงใน log
        Log::error($e->getMessage());

        // ส่งการตอบกลับ JSON พร้อมรายละเอียดข้อผิดพลาด
        return response()->json(['error' => $e->getMessage()], 500); // เพิ่มการแสดงข้อผิดพลาดใน response
    }
}



    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        try {
            // ค้นหาผลิตภัณฑ์ตามไอดี
            $product = Product::findOrFail($id);
    
            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
            ]);
    
            // อัปเดตข้อมูลของผลิตภัณฑ์
            $product->update($validatedData);
    
            // ส่งการตอบกลับ JSON พร้อมข้อมูลสินค้าใหม่
            return response()->json($product, 200);
    
        } catch (\Illuminate\Database\QueryException $e) {
            // แสดงข้อความข้อผิดพลาดจากฐานข้อมูล
            return response()->json(['error' => $e->getMessage()], 500);
    
        } catch (\Exception $e) {
            // แสดงข้อความข้อผิดพลาดทั่วไป
            return response()->json(['error' => 'มีบางอย่างผิดพลาดในกระบวนการอัปเดตข้อมูล'], 500);
        }
    }
    
    

    public function destroy($id)
{
    // ค้นหาสินค้าในฐานข้อมูล
    $product = Product::find($id);

    // ตรวจสอบว่าสินค้ามีอยู่หรือไม่
    if (!$product) {
        return response()->json(['error' => 'Product not found.'], 404);
    }

    // ลบสินค้า
    $product->delete();

    // ส่งการตอบกลับ JSON พร้อมข้อความสำเร็จ
    return response()->json(['success' => 'ลบสินค้าเรียบร้อยแล้ว.'], 200);
}

}

