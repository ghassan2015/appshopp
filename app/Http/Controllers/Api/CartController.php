<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BooksResourse;
use App\Models\Cart;
use App\Models\CartItem;

use App\Http\Resources\CartItemCollection as CartItemCollection;
//use App\Order;
use App\Models\Book;
use App\Traits\GeneralTrait;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use function Livewire\str;

class CartController extends Controller
{
    use GeneralTrait;


//    public function store(Request $request)
//    {
//        if (Auth::guard('api')->check()) {
//            $userID = auth('api')->id();
//        }
//
//        $cart = Cart::create([
//            'id' => md5(uniqid(rand(), true)),
//            'key' => md5(uniqid(rand(), true)),
//            'userID' => isset($userID) ? $userID : null,
//
//        ]);
//
//    }


    public function show(Cart $cart, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cartKey' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $cartKey = $request->input('cartKey');
        if ($cart->key == $cartKey) {
            return response()->json([
                'cart' => $cart->id,
                'Items in Cart' => new CartItemCollection($cart->items),
            ], 200);

        } else {

            return response()->json([
                'message' => 'The CarKey you provided does not match the Cart Key for this Cart.',
            ], 400);
        }

    }


    public function destroy( Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cartKey' => 'required',
            'book_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $cartKey = $request->input('cartKey');
        $book_id = $request->input('book_id');

        $cart = Cart::where('key', $cartKey)->first();
        if (isset($cart)) {
            if ($cart->key == $cartKey && isset($request->book_id)) {
                $cartitem = CartItem::where('cart_id', $cart->id)->where('product_id', $book_id)->delete();

                return $this->returnData('data', 'تم عملية الحذف بنجاح');


            } else {
                return $this->returnError(400, 'السلة غير موجودة');

            }

        }
        return $this->returnError(404, 'هذا العنصر غير متوفر');

    }

    public function addToCart(Cart $cart ,Request $request)
    {

return Auth('api')->id();

        $productID = $request->input('productID');
        $quantity = $request->input('quantity');
        $validator = Validator::make($request->all(), [
            'productID' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }
        $userID =Auth::guard('api')->id();

        if (Auth::guard('api')->id()??null) {

            $userID= Auth::guard('api')->id();
             $cart->update([
                 'userID'=>$userID
             ]);
        }

//

        if ($request->cartKey==$cart->cartKey) {
            $cart = Cart::create([
                'id' => md5(uniqid(rand(), true)),
                'key' => md5(uniqid(rand(), true)),
                'userID' => isset($userID) ? $userID : null,

            ]);

                try {
                    $Product = Book::findOrFail($request->input('productID'));
                } catch (ModelNotFoundException $e) {
                    return response()->json([
                        'message' => 'The Product you\'re trying to add does not exist.',
                    ], 404);
                }

            if (Auth::guard('api')->check()) {
                $userID = auth('api')->id();

//            $cart->update([
//                'userID'=>$userID,
//            ]);
            }


                $cartItem = CartItem::where(['cart_id' => $cart->getKey(), 'product_id' => $productID])->first();
                if ($cartItem) {
                    $cartItem->quantity = $quantity;
                    CartItem::where(['cart_id' => $cart->getKey(), 'product_id' => $productID])->update(['quantity' => $quantity]);
                } else {
                    CartItem::create(['cart_id' => $cart->getKey(), 'product_id' => $productID, 'quantity' => $quantity]);
                }


            $data=[];
            $data['cartKey']= ($cart->key);
            $data['count']=$cart->items->count();


            $data['cart']=$cart->items;

            return $this->returnData('data', $data);





        }else{


            $cart=Cart::where('key',$request->cartKey)->first();
            $userID =Auth::guard('api')->id();

//            if (Auth::guard('api')->check()) {
//                $userID = auth('api')->id();

//            }

            if ($cart->key == $request->cartKey) {


                try {
                    $Product = Book::findOrFail($request->input('productID'));
                } catch (ModelNotFoundException $e) {
                    return response()->json([
                        'message' => 'The Product you\'re trying to add does not exist.',
                    ], 404);
                }

                //check if the the same product is already in the Cart, if true update the quantity, if not create a new one.
                $cartItem = CartItem::where(['cart_id' => $cart->getKey(), 'product_id' => $productID])->first();
                if ($cartItem) {
                    $cartItem->quantity = $quantity;
                    CartItem::where(['cart_id' => $cart->getKey(), 'product_id' => $productID])->update(['quantity' => $quantity]);
                } else {
                    CartItem::create(['cart_id' => $cart->getKey(), 'product_id' => $productID, 'quantity' => $quantity]);
                }
//                $cart->update([
//                    'userID'=>$userID,
//                ]);



                $data=[];
                $data['cartKey']= ($cart->key);
                $data['count']=$cart->items->count();


                $data['cart']=$cart->items;

                return $this->returnData('data', $data);

            } else {

                return response()->json([
                    'message' => 'The CarKey you provided does not match the Cart Key for this Cart.',
                ], 400);
            }
        }






        //Check if the CarKey is Valid


    }

    public function getCart(Request $request){

        try {
            $cart=Cart::where('userID',Auth::guard('api')->id()??'')->orWhere('key',$request->cartKey??null)->first();


            $data=[];
           $data['cartKey']= ($cart->key);
           $data['count']=$cart->items->count();

            if ($cart) {

                $data['cart']=CartItem::where(['cart_id' => $cart->getKey()])->get();


                return $this->returnData('data', $data);

            }else{
                $data=[];

            }
        }catch (\Exception $exception){
            return $this->returnError(400,'error',);
        }




    }






    public function checkout(Cart $cart, Request $request)
    {

        if (Auth::guard('api')->check()) {
            $userID = auth('api')->user()->getKey();
        }

        $validator = Validator::make($request->all(), [
            'cartKey' => 'required',
            'name' => 'required',
            'adress' => 'required',
            'credit card number' => 'required',
            'expiration_year' => 'required',
            'expiration_month' => 'required',
            'cvc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $cartKey = $request->input('cartKey');
        if ($cart->key == $cartKey) {
            $name = $request->input('name');
            $adress = $request->input('adress');
            $creditCardNumber = $request->input('credit card number');
            $TotalPrice = (float) 0.0;
            $items = $cart->items;

            foreach ($items as $item) {

                $product = Book::find($item->product_id);
                $price = $product->price??10;
                $inStock = $product->UnitsInStock;
                if ($inStock >= $item->quantity) {

                    $TotalPrice = $TotalPrice + ($price * $item->quantity);

                    $product->UnitsInStock = $product->UnitsInStock - $item->quantity;
                    $product->save();
                } else {
                    return response()->json([
                        'message' => 'The quantity you\'re ordering of ' . $item->Name .
                            ' isn\'t available in stock, only ' . $inStock . ' units are in Stock, please update your cart to proceed',
                    ], 400);
                }
            }



            $PaymentGatewayResponse = true;
            $transactionID = md5(uniqid(rand(), true));

            if ($PaymentGatewayResponse) {
                $order = Order::create([
                    'products' => json_encode(new CartItemCollection($items)),
                    'totalPrice' => $TotalPrice,
                    'name' => $name,
                    'address' => $adress,
                    'userID' => isset($userID) ? $userID : null,
                    'transactionID' => $transactionID,
                ]);

                $cart->delete();

                return response()->json([
                    'message' => 'you\'re order has been completed succefully, thanks for shopping with us!',
                    'orderID' => $order->getKey(),
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'The CarKey you provided does not match the Cart Key for this Cart.',
            ], 400);
        }

    }

}
