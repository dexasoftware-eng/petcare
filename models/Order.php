<?php

namespace Models;

use Core\Model;

class Order extends Model
{
    protected static string $table = 'orders';

    public static function generateOrderNumber(): string
    {
        return 'FS-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);
    }

    public static function getWithItems(int $orderId): ?array
    {
        $order = self::find($orderId);
        if (!$order) {
            return null;
        }

        $order['items'] = OrderItem::where('order_id = :oid', ['oid' => $orderId]);
        return $order;
    }

    public static function getOrdersByUser(int $userId): array
    {
        return self::where('user_id = :uid', ['uid' => $userId], 'id DESC');
    }
}
