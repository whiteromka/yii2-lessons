<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CartItem;
use app\models\Cat;
use app\models\Order;
use Yii;
use yii\web\Controller;

class CartController extends Controller
{
    /** // http://yii2-lessons.local/cart/add?id=316
     * Добавить кота в корзину
     *
     * @param int $id - ID кота для добавления в корзину
     */
    public function actionAdd(int $id)
    {
        // табл:
        // cart: id, sum, discount_percent, final_sum, status
        // cart_item: id, cart_id, cat_id, price
        // order: id, cart_id, status

        // - Показать таблицы, рассказать общую логику [!]
        // - отрефакторить код ниже [!]
        // - корзина [!]
        // - виджет [!]

        /** @var Cat $cat */
        $cat = Cat::find()->where(['id' => $id])->one();
        $cart = Cart::getActive();

        if ($cat && $cart) {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->cat_id = $id;
            $cartItem->price = $cat->price;
            $successCartItemSave = $cartItem->save();

            if ($successCartItemSave) {
                $cart->sum = $cart->sum + $cat->price;
                if ($cart->sum >= 100000) {
                    $cart->discount_percent = 1;
                }
                if ($cart->discount_percent > 0) {
                    $cart->final_sum = $cart->sum - $cart->getPercentDiscountSum();
                } else {
                    $cart->final_sum = $cart->sum;
                }
                $success = $cart->save();
                if ($success) { // - всплывающее окно об успехе
                    Yii::$app->session->setFlash('success', 'Кот успешно добавлен в корзину!');
                }
            }
        }

        return $this->redirect(['/']);
    }

    /**
     * Страница просмотра всей коризны
     */
    public function actionIndex()
    {
        $cart = Cart::getActive();
        return $this->render('index', [
           'cart' => $cart,
           'cartItems' => $cart->cartItems,
        ]);
    }

    /**
     * Экшен для создания заказа
     */
    public function actionCreateOrder()
    {
        $cart = Cart::getActive();
        $cart->status = 0;
        $cart->save();

        $order = new Order();
        $order->cart_id = $cart->id;
        $order->status = Order::IN_PROCESS;
        $order->save();

        return $this->redirect(['/']);
    }
}