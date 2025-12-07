<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class RealisticProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Clear existing products
        Product::query()->delete();

        $products = [
            // Clothes (Category 1)
            [
                'name' => 'Organic Cotton Onesie Set',
                'slug' => 'organic-cotton-onesie-set',
                'description' => 'Soft and breathable organic cotton onesies perfect for your baby\'s delicate skin. Set of 3 with adorable prints. Made from 100% GOTS certified organic cotton. Features snap closures for easy diaper changes.',
                'price' => 1299,
                'quantity' => 45,
                'category_id' => 1,
                'image' => 'products/onesie-set.jpg'
            ],
            [
                'name' => 'Baby Girl Floral Dress',
                'slug' => 'baby-girl-floral-dress',
                'description' => 'Beautiful floral print dress with matching bloomers. Perfect for special occasions or everyday wear. Soft cotton blend fabric with button closure at back. Available in sizes 0-24 months.',
                'price' => 1899,
                'quantity' => 32,
                'category_id' => 1,
                'image' => 'products/floral-dress.jpg'
            ],
            [
                'name' => 'Toddler Denim Jacket',
                'slug' => 'toddler-denim-jacket',
                'description' => 'Classic denim jacket for toddlers. Durable yet comfortable with adjustable cuffs. Features front pockets and snap button closure. Perfect layering piece for any season.',
                'price' => 2499,
                'quantity' => 28,
                'category_id' => 1,
                'image' => 'products/denim-jacket.jpg'
            ],
            [
                'name' => 'Striped Romper',
                'slug' => 'striped-romper',
                'description' => 'Cute striped romper with snap closure at legs for easy changes. Made from soft jersey knit fabric. Perfect for playtime and outings. Machine washable.',
                'price' => 1599,
                'quantity' => 50,
                'category_id' => 1,
                'image' => 'products/striped-romper.jpg'
            ],
            [
                'name' => 'Winter Fleece Hoodie',
                'slug' => 'winter-fleece-hoodie',
                'description' => 'Warm and cozy fleece hoodie to keep your little one comfortable in cold weather. Features kangaroo pocket and full zip closure. Available in multiple colors.',
                'price' => 2199,
                'quantity' => 38,
                'category_id' => 1,
                'image' => 'products/fleece-hoodie.jpg'
            ],

            // Toys (Category 2)
            [
                'name' => 'Wooden Building Blocks Set',
                'slug' => 'wooden-building-blocks-set',
                'description' => '50-piece wooden building blocks in vibrant colors. Helps develop motor skills and creativity. Made from sustainable wood with non-toxic paint. Includes storage bag.',
                'price' => 2999,
                'quantity' => 42,
                'category_id' => 2,
                'image' => 'products/building-blocks.jpg'
            ],
            [
                'name' => 'Plush Teddy Bear',
                'slug' => 'plush-teddy-bear',
                'description' => 'Super soft and cuddly teddy bear, perfect companion for your little one. Hypoallergenic filling, machine washable. Safety tested for all ages. Height: 12 inches.',
                'price' => 1799,
                'quantity' => 55,
                'category_id' => 2,
                'image' => 'products/teddy-bear.jpg'
            ],
            [
                'name' => 'Musical Activity Cube',
                'slug' => 'musical-activity-cube',
                'description' => 'Interactive activity cube with 5 sides of fun! Features lights, sounds, and various textures. Helps develop sensory and motor skills. Requires 2 AA batteries (included).',
                'price' => 3499,
                'quantity' => 25,
                'category_id' => 2,
                'image' => 'products/activity-cube.jpg'
            ],
            [
                'name' => 'Stacking Rings Toy',
                'slug' => 'stacking-rings-toy',
                'description' => 'Classic stacking rings toy with 6 colorful rings. Teaches size recognition and hand-eye coordination. BPA-free plastic, safe for teething babies.',
                'price' => 899,
                'quantity' => 60,
                'category_id' => 2,
                'image' => 'products/stacking-rings.jpg'
            ],
            [
                'name' => 'Push and Pull Duck',
                'slug' => 'push-pull-duck',
                'description' => 'Adorable wooden duck on wheels that quacks when pulled. Encourages walking and gross motor development. Sturdy construction with smooth edges.',
                'price' => 1999,
                'quantity' => 35,
                'category_id' => 2,
                'image' => 'products/pull-duck.jpg'
            ],

            // Bath (Category 3)
            [
                'name' => 'Baby Bath Tub with Support',
                'slug' => 'baby-bath-tub-support',
                'description' => 'Ergonomic baby bath tub with built-in support sling for newborns. Features temperature indicator and non-slip base. Grows with baby from newborn to toddler.',
                'price' => 3999,
                'quantity' => 22,
                'category_id' => 3,
                'image' => 'products/bath-tub.jpg'
            ],
            [
                'name' => 'Hooded Towel Set',
                'slug' => 'hooded-towel-set',
                'description' => 'Ultra-soft bamboo hooded towels with cute animal designs. Set of 2. Highly absorbent and gentle on baby\'s skin. Machine washable. Size: 30x30 inches.',
                'price' => 1699,
                'quantity' => 48,
                'category_id' => 3,
                'image' => 'products/hooded-towel.jpg'
            ],
            [
                'name' => 'Bath Toy Organizer',
                'slug' => 'bath-toy-organizer',
                'description' => 'Mesh bath toy storage with strong suction cups. Keeps toys organized and allows them to dry properly. Quick-dry mesh prevents mold. Easy to install.',
                'price' => 799,
                'quantity' => 65,
                'category_id' => 3,
                'image' => 'products/toy-organizer.jpg'
            ],
            [
                'name' => 'Gentle Baby Shampoo',
                'slug' => 'gentle-baby-shampoo',
                'description' => 'Tear-free, hypoallergenic baby shampoo with natural ingredients. No parabens, sulfates, or dyes. Dermatologist tested. Fresh baby scent. 16 oz bottle.',
                'price' => 599,
                'quantity' => 80,
                'category_id' => 3,
                'image' => 'products/baby-shampoo.jpg'
            ],
            [
                'name' => 'Floating Bath Toys Set',
                'slug' => 'floating-bath-toys-set',
                'description' => 'Set of 6 colorful floating bath toys including ducks, boats, and sea animals. BPA-free, easy to clean. Makes bath time fun and engaging!',
                'price' => 1299,
                'quantity' => 52,
                'category_id' => 3,
                'image' => 'products/bath-toys.jpg'
            ],

            // Sleep (Category 4)
            [
                'name' => 'Crib Mattress Premium',
                'slug' => 'crib-mattress-premium',
                'description' => 'Dual-sided crib mattress with firm infant side and softer toddler side. Waterproof cover, hypoallergenic materials. Fits standard cribs. Greenguard Gold certified.',
                'price' => 8999,
                'quantity' => 15,
                'category_id' => 4,
                'image' => 'products/crib-mattress.jpg'
            ],
            [
                'name' => 'Muslin Swaddle Blankets',
                'slug' => 'muslin-swaddle-blankets',
                'description' => 'Set of 3 large muslin swaddle blankets in beautiful prints. Breathable, soft, and gets softer with each wash. Size: 47x47 inches. Multi-purpose use.',
                'price' => 2499,
                'quantity' => 40,
                'category_id' => 4,
                'image' => 'products/swaddle-blankets.jpg'
            ],
            [
                'name' => 'White Noise Machine',
                'slug' => 'white-noise-machine',
                'description' => 'Portable white noise machine with 10 soothing sounds. Timer function, adjustable volume. Helps baby sleep better. USB rechargeable with night light feature.',
                'price' => 3299,
                'quantity' => 30,
                'category_id' => 4,
                'image' => 'products/white-noise.jpg'
            ],
            [
                'name' => 'Crib Sheet Set',
                'slug' => 'crib-sheet-set',
                'description' => 'Set of 2 fitted crib sheets in 100% organic cotton. Soft, breathable, and durable. Deep pockets for secure fit. Machine washable. Cute patterns.',
                'price' => 1899,
                'quantity' => 45,
                'category_id' => 4,
                'image' => 'products/crib-sheets.jpg'
            ],
            [
                'name' => 'Baby Sleep Sack',
                'slug' => 'baby-sleep-sack',
                'description' => 'Wearable blanket sleep sack for safe sleeping. TOG 1.0 for year-round use. Zipper closure, armhole design. Available in multiple sizes and colors.',
                'price' => 2199,
                'quantity' => 38,
                'category_id' => 4,
                'image' => 'products/sleep-sack.jpg'
            ],

            // Feed (Category 5)
            [
                'name' => 'Anti-Colic Baby Bottles',
                'slug' => 'anti-colic-baby-bottles',
                'description' => 'Set of 4 anti-colic bottles with slow-flow nipples. Reduces gas and fussiness. BPA-free, dishwasher safe. Includes cleaning brush. 8 oz capacity.',
                'price' => 2799,
                'quantity' => 50,
                'category_id' => 5,
                'image' => 'products/baby-bottles.jpg'
            ],
            [
                'name' => 'High Chair 3-in-1',
                'slug' => 'high-chair-3in1',
                'description' => 'Convertible high chair that grows with your child. Adjustable height, removable tray, reclining seat. Easy to clean. Supports up to 50 lbs. Safety certified.',
                'price' => 12999,
                'quantity' => 12,
                'category_id' => 5,
                'image' => 'products/high-chair.jpg'
            ],
            [
                'name' => 'Silicone Baby Bibs',
                'slug' => 'silicone-baby-bibs',
                'description' => 'Set of 3 waterproof silicone bibs with food catcher pocket. Easy to clean, dishwasher safe. Adjustable neck closure. BPA-free, soft and comfortable.',
                'price' => 1499,
                'quantity' => 55,
                'category_id' => 5,
                'image' => 'products/silicone-bibs.jpg'
            ],
            [
                'name' => 'Baby Food Maker',
                'slug' => 'baby-food-maker',
                'description' => 'All-in-one baby food maker - steams, blends, and reheats. Makes fresh, healthy baby food in minutes. BPA-free, dishwasher safe parts. Recipe book included.',
                'price' => 8999,
                'quantity' => 18,
                'category_id' => 5,
                'image' => 'products/food-maker.jpg'
            ],
            [
                'name' => 'Sippy Cup Set',
                'slug' => 'sippy-cup-set',
                'description' => 'Spill-proof sippy cups with handles, set of 3. Soft spout, easy grip handles. BPA-free, top-rack dishwasher safe. Perfect for transition from bottle. 7 oz.',
                'price' => 1699,
                'quantity' => 60,
                'category_id' => 5,
                'image' => 'products/sippy-cups.jpg'
            ],

            // Care (Category 6)
            [
                'name' => 'Diaper Bag Backpack',
                'slug' => 'diaper-bag-backpack',
                'description' => 'Stylish and functional diaper bag backpack with 14 pockets. Insulated bottle pockets, changing pad included. Water-resistant, durable. Stroller straps included.',
                'price' => 4999,
                'quantity' => 28,
                'category_id' => 6,
                'image' => 'products/diaper-bag.jpg'
            ],
            [
                'name' => 'Baby Nail Care Set',
                'slug' => 'baby-nail-care-set',
                'description' => 'Complete nail care kit with safety scissors, clippers, and files. Rounded edges for safety. Includes LED light for nighttime trimming. Storage case included.',
                'price' => 899,
                'quantity' => 70,
                'category_id' => 6,
                'image' => 'products/nail-care.jpg'
            ],
            [
                'name' => 'Baby Monitor with Camera',
                'slug' => 'baby-monitor-camera',
                'description' => 'HD video baby monitor with night vision, two-way audio, and temperature sensor. 5-inch screen, long battery life. Pan/tilt/zoom features. Lullabies included.',
                'price' => 15999,
                'quantity' => 10,
                'category_id' => 6,
                'image' => 'products/baby-monitor.jpg'
            ],
            [
                'name' => 'Diaper Cream',
                'slug' => 'diaper-cream',
                'description' => 'Zinc oxide diaper rash cream that soothes and protects. Hypoallergenic, fragrance-free. Pediatrician recommended. Creates protective barrier. 4 oz tube.',
                'price' => 699,
                'quantity' => 85,
                'category_id' => 6,
                'image' => 'products/diaper-cream.jpg'
            ],
            [
                'name' => 'Baby Thermometer Digital',
                'slug' => 'baby-thermometer-digital',
                'description' => 'Fast and accurate digital thermometer with fever indicator. Oral, rectal, or underarm use. Memory recall, automatic shut-off. Includes protective case.',
                'price' => 1299,
                'quantity' => 50,
                'category_id' => 6,
                'image' => 'products/thermometer.jpg'
            ],

            // Travel (Category 7)
            [
                'name' => 'Lightweight Stroller',
                'slug' => 'lightweight-stroller',
                'description' => 'Compact, lightweight stroller perfect for travel. One-hand fold, reclining seat, large canopy. Cup holder and storage basket. Supports up to 50 lbs.',
                'price' => 18999,
                'quantity' => 8,
                'category_id' => 7,
                'image' => 'products/stroller.jpg'
            ],
            [
                'name' => 'Car Seat Convertible',
                'slug' => 'car-seat-convertible',
                'description' => 'Convertible car seat for rear and forward facing. Side impact protection, 5-point harness. Machine washable cover. Grows with child 5-65 lbs. Safety certified.',
                'price' => 24999,
                'quantity' => 15,
                'category_id' => 7,
                'image' => 'products/car-seat.jpg'
            ],
            [
                'name' => 'Baby Carrier Ergonomic',
                'slug' => 'baby-carrier-ergonomic',
                'description' => 'Ergonomic baby carrier with lumbar support. Multiple carrying positions. Breathable mesh, adjustable straps. Supports 8-33 lbs. Machine washable.',
                'price' => 8999,
                'quantity' => 25,
                'category_id' => 7,
                'image' => 'products/baby-carrier.jpg'
            ],
            [
                'name' => 'Travel Crib Portable',
                'slug' => 'travel-crib-portable',
                'description' => 'Portable travel crib with carry bag. Easy setup, breathable mesh sides. Includes fitted sheet and mattress pad. Folds compactly. Great for travel!',
                'price' => 11999,
                'quantity' => 18,
                'category_id' => 7,
                'image' => 'products/travel-crib.jpg'
            ],
            [
                'name' => 'Stroller Organizer',
                'slug' => 'stroller-organizer',
                'description' => 'Universal stroller organizer with cup holders and zippered pockets. Insulated compartments, phone holder. Easy attachment, fits most strollers. Water-resistant.',
                'price' => 1999,
                'quantity' => 45,
                'category_id' => 7,
                'image' => 'products/stroller-organizer.jpg'
            ],

            // Gifts (Category 8)
            [
                'name' => 'Baby Memory Book',
                'slug' => 'baby-memory-book',
                'description' => 'Beautiful keepsake memory book to record baby\'s first year. Includes milestone stickers, photo pages, and prompts. Acid-free pages, elegant design.',
                'price' => 2499,
                'quantity' => 35,
                'category_id' => 8,
                'image' => 'products/memory-book.jpg'
            ],
            [
                'name' => 'Personalized Baby Blanket',
                'slug' => 'personalized-baby-blanket',
                'description' => 'Soft minky blanket with custom name embroidery. Perfect gift for newborns. Machine washable, hypoallergenic. Size: 30x40 inches. Multiple color options.',
                'price' => 3499,
                'quantity' => 30,
                'category_id' => 8,
                'image' => 'products/personalized-blanket.jpg'
            ],
            [
                'name' => 'Baby Gift Basket',
                'slug' => 'baby-gift-basket',
                'description' => 'Curated gift basket with essentials: onesies, blanket, toys, and care items. Beautifully packaged, ready to gift. Perfect for baby showers!',
                'price' => 7999,
                'quantity' => 20,
                'category_id' => 8,
                'image' => 'products/gift-basket.jpg'
            ],
            [
                'name' => 'Handprint & Footprint Kit',
                'slug' => 'handprint-footprint-kit',
                'description' => 'Create lasting memories with this clay impression kit. Safe, non-toxic clay. Includes frame and display stand. Perfect keepsake gift for parents.',
                'price' => 1899,
                'quantity' => 40,
                'category_id' => 8,
                'image' => 'products/handprint-kit.jpg'
            ],
            [
                'name' => 'Baby Milestone Cards',
                'slug' => 'baby-milestone-cards',
                'description' => 'Set of 30 milestone cards for photo moments. Beautifully designed, premium cardstock. Capture first smile, steps, and more. Includes storage box.',
                'price' => 1299,
                'quantity' => 50,
                'category_id' => 8,
                'image' => 'products/milestone-cards.jpg'
            ],

            // Gear (Category 9)
            [
                'name' => 'Baby Swing & Rocker',
                'slug' => 'baby-swing-rocker',
                'description' => '2-in-1 baby swing and rocker with multiple speeds and music. Plush seat, 5-point harness. Portable design. Requires 4 D batteries or AC adapter (included).',
                'price' => 14999,
                'quantity' => 12,
                'category_id' => 9,
                'image' => 'products/baby-swing.jpg'
            ],
            [
                'name' => 'Play Gym Activity Mat',
                'slug' => 'play-gym-activity-mat',
                'description' => 'Colorful play gym with hanging toys and mirror. Soft padded mat, machine washable. Encourages tummy time and sensory development. Folds for storage.',
                'price' => 5999,
                'quantity' => 22,
                'category_id' => 9,
                'image' => 'products/play-gym.jpg'
            ],
            [
                'name' => 'Bouncer Seat',
                'slug' => 'bouncer-seat',
                'description' => 'Calming vibrations bouncer seat with toy bar. Adjustable recline, machine washable fabric. Supports up to 20 lbs. Folds flat for easy storage.',
                'price' => 6999,
                'quantity' => 18,
                'category_id' => 9,
                'image' => 'products/bouncer-seat.jpg'
            ],
            [
                'name' => 'Baby Gate Extra Wide',
                'slug' => 'baby-gate-extra-wide',
                'description' => 'Pressure-mounted safety gate, extends 29-38 inches. Auto-close feature, one-hand operation. No drilling required. Meets safety standards.',
                'price' => 4999,
                'quantity' => 25,
                'category_id' => 9,
                'image' => 'products/baby-gate.jpg'
            ],
            [
                'name' => 'Changing Table Organizer',
                'slug' => 'changing-table-organizer',
                'description' => 'Hanging organizer for changing table with multiple pockets. Stores diapers, wipes, creams. Easy access, space-saving. Attaches to most changing tables.',
                'price' => 2499,
                'quantity' => 35,
                'category_id' => 9,
                'image' => 'products/changing-organizer.jpg'
            ],

            // Moms (Category 11)
            [
                'name' => 'Nursing Pillow',
                'slug' => 'nursing-pillow',
                'description' => 'Ergonomic nursing pillow with removable, washable cover. Firm support for comfortable feeding. Multi-use: nursing, tummy time, sitting support.',
                'price' => 3999,
                'quantity' => 30,
                'category_id' => 11,
                'image' => 'products/nursing-pillow.jpg'
            ],
            [
                'name' => 'Breast Pump Electric',
                'slug' => 'breast-pump-electric',
                'description' => 'Double electric breast pump with multiple suction levels. Quiet motor, portable design. Includes bottles, storage bags, and cooler bag. BPA-free.',
                'price' => 19999,
                'quantity' => 15,
                'category_id' => 11,
                'image' => 'products/breast-pump.jpg'
            ],
            [
                'name' => 'Maternity Pillow',
                'slug' => 'maternity-pillow',
                'description' => 'Full-body pregnancy pillow for comfortable sleep. Supports back, belly, and legs. Removable, washable cover. Can be used postpartum for nursing.',
                'price' => 5999,
                'quantity' => 20,
                'category_id' => 11,
                'image' => 'products/maternity-pillow.jpg'
            ],
            [
                'name' => 'Nursing Pads Reusable',
                'slug' => 'nursing-pads-reusable',
                'description' => 'Set of 8 washable nursing pads. Super absorbent, leak-proof. Soft bamboo fabric, contoured shape. Includes laundry bag. Eco-friendly alternative.',
                'price' => 1499,
                'quantity' => 45,
                'category_id' => 11,
                'image' => 'products/nursing-pads.jpg'
            ],
            [
                'name' => 'Postpartum Recovery Kit',
                'slug' => 'postpartum-recovery-kit',
                'description' => 'Complete recovery kit with essentials for new moms. Includes peri bottle, ice packs, sitz bath, and more. Hospital-grade quality. Discreet packaging.',
                'price' => 4999,
                'quantity' => 25,
                'category_id' => 11,
                'image' => 'products/recovery-kit.jpg'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Created ' . count($products) . ' realistic products across all categories!');
    }
}
