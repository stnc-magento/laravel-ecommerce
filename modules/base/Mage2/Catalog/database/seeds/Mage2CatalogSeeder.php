<?php

use Illuminate\Database\Seeder;
use Mage2\Attribute\Models\AttributeDropdownOption;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Order\Models\OrderStatus;
use Mage2\TaxClass\Models\Country;
use Mage2\Configuration\Models\Configuration;
use Mage2\Install\Models\Website;
use Mage2\Attribute\Models\ProductAttributeGroup;

class Mage2CatalogSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $productAttributeGroup = ProductAttributeGroup::create(['title' => 'Basic']);
        $seoGroup = ProductAttributeGroup::create(['title' => 'SEO']);
        $inventoryGroup = ProductAttributeGroup::create(['title' => 'Inventory']);

        ProductAttribute::insert([
            [
                'title' => 'Title',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'title',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255',
            ],
            [
                'title' => 'Price',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'price',
                'type' => 'FLOAT',
                'field_type' => 'TEXT',
                'validation' => 'required|max:8|regex:/^-?\\d*(\\.\\d+)?$/',
            ],
            [
                'title' => 'Image',
                'product_attribute_group_id' => 0,
                'identifier' => 'image',
                'type' => 'FILE',
                'field_type' => 'FILE',
                'validation' => '',
            ],
            [
                'title' => 'SKU',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'sku',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255',
            ],
            [
                'title' => 'Slug',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'slug',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255|alpha_dash',
            ],
            [
                'title' => 'Page Title',
                'product_attribute_group_id' => $seoGroup->id,
                'identifier' => 'page_title',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'max:255',
            ],
            [
                'title' => 'Page Description',
                'product_attribute_group_id' => $seoGroup->id,
                'identifier' => 'page_description',
                'type' => 'VARCHAR',
                'field_type' => 'TEXTAREA',
                'validation' => 'max:255',
            ],
            [
                'title' => 'Qty',
                'product_attribute_group_id' => $inventoryGroup->id,
                'identifier' => 'qty',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => '',
            ],
            [
                'title' => 'Description',
                'product_attribute_group_id' => $productAttributeGroup->id,
                'identifier' => 'description',
                'type' => 'TEXT',
                'field_type' => 'TEXTAREA',
                'validation' => 'required',
            ],
        ]);

        $statusAttribute = ProductAttribute::create([
                    'title' => 'Status',
                    'product_attribute_group_id' => $productAttributeGroup->id,
                    'identifier' => 'status',
                    'type' => 'VARCHAR',
                    'field_type' => 'SELECT',
                    'validation' => 'required',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $statusAttribute->id,
            'value' => '1',
            'label' => 'Enabled',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $statusAttribute->id,
            'value' => '0',
            'label' => 'Disabled',
        ]);

        $isTaxableAttribute = ProductAttribute::create([
                    'title' => 'Is Taxable',
                    'product_attribute_group_id' => $inventoryGroup->id,
                    'identifier' => 'is_taxable',
                    'type' => 'VARCHAR',
                    'field_type' => 'SELECT',
                    'validation' => 'required',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $isTaxableAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $isTaxableAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);



        $featureAttribute = ProductAttribute::create([
                    'title' => 'Is Featured',
                    'product_attribute_group_id' => $productAttributeGroup->id,
                    'identifier' => 'is_featured',
                    'type' => 'VARCHAR',
                    'field_type' => 'SELECT',
                    'validation' => 'required',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);

        $inStockAttribute = ProductAttribute::create([
                    'title' => 'In Stock',
                    'product_attribute_group_id' => $inventoryGroup->id,
                    'identifier' => 'in_stock',
                    'type' => 'VARCHAR',
                    'field_type' => 'SELECT',
                    'validation' => 'required',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $inStockAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $inStockAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);

        $trackStockAttribute = ProductAttribute::create([
                    'title' => 'Track Stock',
                    'product_attribute_group_id' => $inventoryGroup->id,
                    'identifier' => 'track_stock',
                    'type' => 'VARCHAR',
                    'field_type' => 'SELECT',
                    'validation' => '',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $trackStockAttribute->id,
            'value' => '1',
            'label' => 'Yes',
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $trackStockAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);
        OrderStatus::insert(
                ['title' => 'pending', 'is_default' => 1, 'is_last_stage' => 0], ['title' => 'processing', 'is_default' => 0, 'is_last_stage' => 0], ['title' => 'complete', 'is_default' => 0, 'is_last_stage' => 1]
        );


        $path = public_path() . '/countries.json';

        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $code => $name) {
            $countires[] = ['code' => $code, 'name' => $name];
        }

        Country::insert($countires);
    }

}
