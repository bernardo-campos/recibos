<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
            RECEIPTS
        */
        
        /* receipts */
        Permission::create(['name' => 'receipt.index']);
        Permission::create(['name' => 'receipt.create']);
        Permission::create(['name' => 'receipt.edit']);
        Permission::create(['name' => 'receipt.show']);
        // Permission::create(['name' => 'receipt.delete']);

        /* receipt concepts */
        Permission::create(['name' => 'concept.receipt.index']);
        Permission::create(['name' => 'concept.receipt.create']);
        Permission::create(['name' => 'concept.receipt.edit']);
        // Permission::create(['name' => 'concept.receipt.show']);
        // Permission::create(['name' => 'concept.receipt.delete']);

        /* froms */
        Permission::create(['name' => 'from.index']);
        Permission::create(['name' => 'from.create']);
        Permission::create(['name' => 'from.edit']);
        // Permission::create(['name' => 'from.show']);
        // Permission::create(['name' => 'from.delete']);
        
        /* -------------------------------------------------------- */
        
        /* 
            PAYMENT_ORDERS
        */

        /* payment_order concepts */
        Permission::create(['name' => 'concept.payment_order.index']);
        Permission::create(['name' => 'concept.payment_order.create']);
        Permission::create(['name' => 'concept.payment_order.edit']);
        // Permission::create(['name' => 'concept.payment_order.show']);
        // Permission::create(['name' => 'concept.payment_order.delete']);

        /* payment_orders */
        Permission::create(['name' => 'payment_order.index']);
        Permission::create(['name' => 'payment_order.create']);
        Permission::create(['name' => 'payment_order.edit']);
        Permission::create(['name' => 'payment_order.show']);
        // Permission::create(['name' => 'payment_order.delete']);

        /* tos */
        Permission::create(['name' => 'to.index']);
        Permission::create(['name' => 'to.create']);
        Permission::create(['name' => 'to.edit']);
        // Permission::create(['name' => 'to.show']);
        // Permission::create(['name' => 'to.delete']);
        
        /* establishments */
        Permission::create(['name' => 'establishment.index']);
        Permission::create(['name' => 'establishment.create']);
        Permission::create(['name' => 'establishment.edit']);
        // Permission::create(['name' => 'establishment.show']);
        // Permission::create(['name' => 'establishment.delete']);

        /* -------------------------------------------------------- */
        
        /* 
            RECEIPTS & PAYMENT_ORDERS
        */

        /* banks */
        Permission::create(['name' => 'bank.index']);
        Permission::create(['name' => 'bank.create']);
        Permission::create(['name' => 'bank.edit']);
        // Permission::create(['name' => 'bank.show']);
        // Permission::create(['name' => 'bank.delete']);
        
        /* accounts */
        Permission::create(['name' => 'account.index']);
        Permission::create(['name' => 'account.create']);
        Permission::create(['name' => 'account.edit']);
        // Permission::create(['name' => 'account.show']);
        // Permission::create(['name' => 'account.delete']);
    }
}
