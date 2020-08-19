<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $order_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Cart findByUser($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart missingOrderItems()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property string $tax
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Range[] $ranges
 * @property-read int|null $ranges_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 */
	class Country extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\Order
 *
 * @property int $id
 * @property int $state_id
 * @property int $address_id
 * @property int $user_id
 * @property int $shipping_id
 * @property int $price
 * @property int|null $invoice_id
 * @property string|null $invoice_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Users\Address $address
 * @property-read mixed $reference
 * @property-read mixed $shipping_amount
 * @property-read mixed $shipping_company
 * @property-read mixed $status
 * @property-read mixed $total
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\OrderItem[] $order_items
 * @property-read int|null $order_items_count
 * @property-read \App\Models\Orders\Payment|null $payment
 * @property-read \App\Models\Orders\Shipping $shipping
 * @property-read \App\Models\Orders\State $state
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order allByUser(\App\Models\Users\User $user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 */
	class Order extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\OrderItem
 *
 * @property int $id
 * @property int $product_option_id
 * @property int $order_id
 * @property int $size_id
 * @property string|null $name
 * @property string $tax
 * @property int $price
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders\Order $order
 * @property-read \App\Models\Products\ProductOption $product_option
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\Payment
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property string $type
 * @property string $payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders\Order $order
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 */
	class Payment extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\Range
 *
 * @property int $id
 * @property int $max
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @property-read int|null $countries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Range byWeight($weight)
 * @method static \Illuminate\Database\Eloquent\Builder|Range newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Range newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Range query()
 */
	class Range extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\Shipping
 *
 * @property int $id
 * @property int $company_id
 * @property int $country_id
 * @property int $range_id
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders\ShippingCompany $company
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\Orders\Range $range
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping byWeight($weight, $country = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping query()
 */
	class Shipping extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\ShippingCompany
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Shipping[] $shippings
 * @property-read int|null $shippings_count
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingCompany query()
 */
	class ShippingCompany extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * App\Models\Orders\State
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $color
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 */
	class State extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 */
	class Page extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 */
	class Category extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Color
 *
 * @property int $id
 * @property string $name
 * @property-read \App\Models\Products\ProductOption $product_option
 * @method static \Illuminate\Database\Eloquent\Builder|Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color query()
 */
	class Color extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Image
 *
 * @property int $id
 * @property int $product_option_id
 * @property string $filename
 * @property int $is_main
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products\ProductOption $product_option
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 */
	class Image extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Material
 *
 * @property int $id
 * @property string $name
 * @property-read \App\Models\Products\ProductOption $product_option
 * @method static \Illuminate\Database\Eloquent\Builder|Material newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material query()
 */
	class Material extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Product
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $categories_list
 * @property-read string $excerpt
 * @property-read mixed $first_option
 * @property-read bool $is_in_wishlist
 * @property-read mixed $main_image
 * @property-read mixed $main_image_path
 * @property-read mixed $path
 * @property-read mixed $price
 * @property-read mixed $quantity
 * @property-read mixed $sizes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\ProductOption[] $product_options
 * @property-read int|null $product_options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wish[] $wishes
 * @property-read int|null $wishes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product last()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product randomProducts($number = 12)
 */
	class Product extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\ProductOption
 *
 * @property int $id
 * @property int $product_id
 * @property int $color_id
 * @property int $material_id
 * @property int $price
 * @property int $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products\Color $color
 * @property-read mixed $classname
 * @property-read mixed $default_size
 * @property-read mixed $main_image
 * @property-read mixed $main_image_path
 * @property-read mixed $sizes_available_formatted
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Products\Material $material
 * @property-read \App\Models\Products\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Size[] $sizes
 * @property-read int|null $sizes_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOption query()
 */
	class ProductOption extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Size
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\ProductOption[] $product_option
 * @property-read int|null $product_option_count
 * @method static \Illuminate\Database\Eloquent\Builder|Size newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Size query()
 */
	class Size extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $bic
 * @property string $iban
 * @property string $bank
 * @property string $bank_address
 * @property string $phone
 * @property string $home
 * @property string $home_infos
 * @property string $home_shipping
 * @property int $invoice
 * @property int $card
 * @property int $transfer
 * @property int $check
 * @property int $mandat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 */
	class Shop extends \Eloquent {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\Address
 *
 * @property int $id
 * @property int $user_id
 * @property int $country_id
 * @property string $name
 * @property string|null $firstname
 * @property string|null $lastname
 * @property int $professionnal
 * @property string|null $company
 * @property string $address
 * @property string|null $info_address
 * @property string $zipcode
 * @property string $city
 * @property string $phone
 * @property int $is_main
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Country $country
 * @property-read mixed $full_address
 * @property-read mixed $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Address allByUser(\App\Models\Users\User $user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Query\Builder|Address onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Query\Builder|Address withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Address withoutTrashed()
 */
	class Address extends \Eloquent {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 */
	class Permission extends \Eloquent {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role allWithoutAdmin()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 */
	class Role extends \Eloquent {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\User
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string $email
 * @property string $password
 * @property int $newsletter
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\Cart|null $cart
 * @property-read mixed $address
 * @property-read mixed $full_name
 * @property-read bool $has_already_cart
 * @property-read mixed $permissions_throught_roles_in_string
 * @property-read mixed $roles_string
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Users\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wish[] $wishes
 * @property-read int|null $wishes_count
 * @method static \Illuminate\Database\Eloquent\Builder|User admins($isAdmin = true)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Wish
 *
 * @property int $product_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products\Product $product
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Wish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wish remove($productId, $userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Wish wishlist()
 */
	class Wish extends \Eloquent {}
}

