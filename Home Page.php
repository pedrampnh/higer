<?php
/**
 * Higer Home | No-build v2.4 | بدون فوتر
 * ============================================================
 * این فایل را مستقیم در WPCode بچسبانید؛ همین فایل هم «سورس» است
 * و هم «خروجی». برای هر ویرایش بعدی فقط همین فایل را باز کنید —
 * دیگر هیچ مرحله بیلد، npm یا فایل dist لازم نیست.
 *
 * ─── راهنمای نصب (۲ دقیقه) ───
 *  ۱. افزونه WPCode > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل همین فایل را Paste کنید > Insert Method روی Shortcode
 *  ۳. Save + Activate > شورت‌کدی که WPCode می‌دهد را در صفحه اصلی
 *     بگذارید (بلوک Shortcode گوتنبرگ یا ویدجت Shortcode المنتور).
 *
 * ─── شورت‌کدها ───
 *  [higer_home]                 نمایش کامل صفحه
 *  [higer_home only="finder"]   فقط تشک‌سنج (مثلاً داخل یک برگه جدا)
 *  [higer_home fullwidth="no"]  بدون حالت تمام‌عرض
 *
 * ─── ویرایش محتوا ───
 *  فقط «بخش ۱: تنظیمات» پایین را دست بزنید؛ متن‌ها، قیمت‌ها، مدل‌ها،
 *  سؤالات متداول و عکس‌ها همه داخل تابع higer_home_config() است.
 *  «بخش ۲: موتور نمایش» را فقط اگر با HTML/PHP آشنا هستید تغییر بدهید.
 *
 * ─── نکته فنی ───
 *  WPCode کد اسنیپت را داخل یک متد eval می‌کند؛ برای همین تنظیمات داخل
 *  یک تابع برگردانده می‌شوند (نه متغیر سراسری) تا در هر حالتی کار کند.
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   هر سطر یک چیز واضح است: متن، قیمت (تومان، بدون کاما)، یا لیست.
   برای افزودن محصول جدید، یک بلوک array( ... ) را کپی کنید.
   ============================================================ */

if ( ! function_exists( 'higer_home_config' ) ) :
function higer_home_config() {

	/* --- فروشگاه و تماس --- */
	$store = array(
		'phone'   => '۰۹۱۱۱۱۸۶۴۸۵',        // شماره نمایشی (فارسی)
		'tel'     => 'tel:+989111186485', // لینک تماس
		'est'     => '۱۳۸۷',              // سال تأسیس
		'shop'    => 'https://higermattress.ir', // برای دکمه‌های «مشاهده مدل»
	);

	/* --- هیرو (سکشن اول) --- */
	$hero = array(
		'badge'  => 'تشک هیگر',
		'titleA' => 'تشک هیگر',
		'titleB' => 'انتخابی برای خواب راحت', // سطر دوم (طلایی)
		'desc'   => 'با مدل‌های تشک هیگر آشنا شوید و با پاسخ به چند سؤال، انتخابتان را محدودتر کنید.',
		'cta1'   => 'شروع تشک‌سنج',
		'cta2'   => 'تماس با فروشگاه',
	);

	/* --- نوار متحرک اعتماد زیر هیرو --- */
	$marquee = array(
		'تشک‌های فنری و فومی',
		'راهنمای انتخاب تشک',
		'تاپر و محافظ تشک',
	);

	/* --- ۴ هسته تشک — کلید key را عوض نکنید (به محصولات وصل است) --- */
	$cores = array(
		array(
			'key' => 'bonnell', 'fa' => 'فنر متصل', 'en' => 'Bonnell Spring',
			'short' => 'فنرهای متصل در هسته تشک یک شبکه به‌هم‌پیوسته تشکیل می‌دهند.',
			'ideal' => '',
			'models' => 'کانگورو، اکونومیک، روکسانا، همر و تراست',
			'price' => 11200000,
			'category_path' => '/product-category/mattress/spring/bonnell-spring/',
		),
		array(
			'key' => 'pocket', 'fa' => 'فنر منفصل', 'en' => 'Pocket Spring',
			'short' => 'فنرهای این نوع تشک در پاکت‌های جداگانه قرار دارند.',
			'ideal' => '',
			'models' => 'الدورادو',
			'price' => 282000000,
			'category_path' => '/product-category/mattress/spring/pocket-spring/',
		),
		array(
			'key' => 'rebond', 'fa' => 'ریباند (بدون فنر)', 'en' => 'Rebounded Foam',
			'short' => 'هسته ریباند از قطعات فوم فشرده‌شده ساخته می‌شود.',
			'ideal' => '',
			'models' => 'راینو، رومانس',
			'price' => 63000000,
			'category_path' => '/product-category/mattress/no-spring/rebound/',
		),
		array(
			'key' => 'foam', 'fa' => 'فوم سنگین', 'en' => 'High-Density Foam',
			'short' => 'در این نوع تشک از فوم به‌عنوان هسته استفاده می‌شود.',
			'ideal' => '',
			'models' => 'نایت، کوئین، اومئا، آوینا و هلسا',
			'price' => 14600000,
			'category_path' => '/product-category/mattress/no-spring/high-density-foam/',
		),
	);

	/* --- داده‌های ثابت تشک‌سنج: قیمت به تومان؛ برخی امتیازها برآوردی‌اند و باید بازبینی شوند --- */
	$products = array(
		array( 'id' => 'kangaroo', 'fa' => 'کانگورو', 'en' => 'Kangaroo', 'core' => 'bonnell', 'price' => 11200000,
			'firm' => 2, 'support' => 4, 'motion' => 2, 'cooling' => 4, 'ortho' => 2,
			'min' => 55, 'max' => 110, 'warranty' => 1,
			'pos' => array( 'back', 'stomach' ),
			'blurb' => '',
		),
		array( 'id' => 'economic', 'fa' => 'اکونومیک', 'en' => 'Economic', 'core' => 'bonnell', 'price' => 14600000,
			'firm' => 2, 'support' => 4, 'motion' => 2, 'cooling' => 4, 'ortho' => 2,
			'min' => 55, 'max' => 115, 'warranty' => 1,
			'pos' => array( 'back', 'stomach', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'roxana', 'fa' => 'روکسانا', 'en' => 'Roxana', 'core' => 'bonnell', 'price' => 30000000,
			'firm' => 2, 'support' => 4, 'motion' => 2, 'cooling' => 3, 'ortho' => 2,
			'min' => 45, 'max' => 100, 'warranty' => 3,
			'pos' => array( 'back', 'combo', 'side' ),
			'blurb' => '',
		),
		array( 'id' => 'roxana-plus', 'fa' => 'روکسانا پلاس', 'en' => 'Roxana+', 'core' => 'bonnell', 'price' => 24000000,
			'firm' => 4, 'support' => 4, 'motion' => 2, 'cooling' => 3, 'ortho' => 3,
			'min' => 60, 'max' => 115, 'warranty' => 2,
			'pos' => array( 'back', 'stomach' ),
			'blurb' => '',
		),
		array( 'id' => 'hammer', 'fa' => 'همر', 'en' => 'Hammer', 'core' => 'bonnell', 'price' => 45000000,
			'firm' => 4, 'support' => 5, 'motion' => 2, 'cooling' => 3, 'ortho' => 3,
			'min' => 75, 'max' => 135, 'warranty' => 3,
			'pos' => array( 'back', 'stomach' ),
			'blurb' => '',
		),
		array( 'id' => 'trust', 'fa' => 'تراست', 'en' => 'Trust', 'core' => 'bonnell', 'price' => 35000000,
			'firm' => 2, 'support' => 5, 'motion' => 2, 'cooling' => 3, 'ortho' => 3,
			'min' => 60, 'max' => 120, 'warranty' => 3,
			'pos' => array( 'back', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'eldorado', 'fa' => 'الدورادو سوپرلوکس', 'en' => 'Eldorado', 'core' => 'pocket', 'price' => 282000000,
			'firm' => 1, 'support' => 5, 'motion' => 5, 'cooling' => 3, 'ortho' => 4,
			'min' => 40, 'max' => 130, 'warranty' => 7,
			'pos' => array( 'side', 'back', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'amsterdam', 'fa' => 'آمستردام', 'en' => 'Amsterdam', 'core' => 'bonnell', 'price' => 78000000,
			'firm' => 1, 'support' => 4, 'motion' => 5, 'cooling' => 4, 'ortho' => 2,
			'min' => 40, 'max' => 120, 'warranty' => 4,
			'pos' => array( 'side', 'back', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'avatar', 'fa' => 'آواتار', 'en' => 'Avatar', 'core' => 'bonnell', 'price' => 75000000,
			'firm' => 4, 'support' => 4, 'motion' => 5, 'cooling' => 4, 'ortho' => 2,
			'min' => 35, 'max' => 105, 'warranty' => 4,
			'pos' => array( 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'zaster', 'fa' => 'زستر', 'en' => 'Zaster', 'core' => 'bonnell', 'price' => 88000000,
			'firm' => 1, 'support' => 5, 'motion' => 5, 'cooling' => 4, 'ortho' => 3,
			'min' => 50, 'max' => 125, 'warranty' => 5,
			'pos' => array( 'back', 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'rhino', 'fa' => 'راینو', 'en' => 'Rhino', 'core' => 'rebond', 'price' => 63000000,
			'firm' => 5, 'support' => 5, 'motion' => 5, 'cooling' => 3, 'ortho' => 5,
			'min' => 70, 'max' => 160, 'warranty' => 4,
			'pos' => array( 'back', 'stomach' ),
			'blurb' => '',
		),
		array( 'id' => 'romance', 'fa' => 'رومانس', 'en' => 'Romance', 'core' => 'rebond', 'price' => 78000000,
			'firm' => 4, 'support' => 5, 'motion' => 5, 'cooling' => 3, 'ortho' => 5,
			'min' => 55, 'max' => 140, 'warranty' => 4,
			'pos' => array( 'back', 'combo', 'side' ),
			'blurb' => '',
		),
		array( 'id' => 'climax', 'fa' => 'کلایمکس', 'en' => 'Climax', 'core' => 'bonnell', 'price' => 55000000,
			'firm' => 1, 'support' => 4, 'motion' => 5, 'cooling' => 3, 'ortho' => 4,
			'min' => 55, 'max' => 130, 'warranty' => 4,
			'pos' => array( 'back', 'side' ),
			'blurb' => '',
		),
		array( 'id' => 'hippo', 'fa' => 'هیپو', 'en' => 'Hippo', 'core' => 'bonnell', 'price' => 55000000,
			'firm' => 2, 'support' => 4, 'motion' => 5, 'cooling' => 3, 'ortho' => 4,
			'min' => 50, 'max' => 125, 'warranty' => 4,
			'pos' => array( 'back', 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'knight', 'fa' => 'نایت', 'en' => 'Knight', 'core' => 'foam', 'price' => 14600000,
			'firm' => 5, 'support' => 4, 'motion' => 5, 'cooling' => 2, 'ortho' => 3,
			'min' => 45, 'max' => 110, 'warranty' => 1,
			'pos' => array( 'back', 'stomach', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'queen', 'fa' => 'کوئین', 'en' => 'Queen', 'core' => 'foam', 'price' => 19300000,
			'firm' => 5, 'support' => 4, 'motion' => 5, 'cooling' => 3, 'ortho' => 3,
			'min' => 40, 'max' => 110, 'warranty' => 2,
			'pos' => array( 'back', 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'queen-plus', 'fa' => 'کوئین پلاس', 'en' => 'Queen+', 'core' => 'foam', 'price' => 28000000,
			'firm' => 5, 'support' => 4, 'motion' => 5, 'cooling' => 3, 'ortho' => 4,
			'min' => 40, 'max' => 115, 'warranty' => 3,
			'pos' => array( 'side', 'back', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'umea', 'fa' => 'اومئا', 'en' => 'Umea', 'core' => 'foam', 'price' => 27200000,
			'firm' => 5, 'support' => 3, 'motion' => 5, 'cooling' => 4, 'ortho' => 2,
			'min' => 30, 'max' => 85, 'warranty' => 3,
			'pos' => array( 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'avina', 'fa' => 'آوینا', 'en' => 'Avina', 'core' => 'foam', 'price' => 55000000,
			'firm' => 4, 'support' => 4, 'motion' => 5, 'cooling' => 4, 'ortho' => 3,
			'min' => 40, 'max' => 115, 'warranty' => 3,
			'pos' => array( 'back', 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'helsa', 'fa' => 'هلسا', 'en' => 'Helsa', 'core' => 'foam', 'price' => 88000000,
			'firm' => 4, 'support' => 5, 'motion' => 5, 'cooling' => 4, 'ortho' => 4,
			'min' => 45, 'max' => 125, 'warranty' => 5,
			'pos' => array( 'back', 'side', 'combo' ),
			'blurb' => '',
		),
		array( 'id' => 'pleasure', 'fa' => 'پلژر', 'en' => 'Pleasure', 'core' => 'bonnell', 'price' => 35000000,
			'firm' => 2, 'support' => 4, 'motion' => 5, 'cooling' => 4, 'ortho' => 3,
			'min' => 35, 'max' => 100, 'warranty' => 3,
			'pos' => array( 'side', 'back' ),
			'blurb' => '',
		),
		array( 'id' => 'pleasure-plus', 'fa' => 'پلژر پلاس', 'en' => 'Pleasure+', 'core' => 'bonnell', 'price' => 45000000,
			'firm' => 2, 'support' => 4, 'motion' => 5, 'cooling' => 4, 'ortho' => 3,
			'min' => 35, 'max' => 105, 'warranty' => 3,
			'pos' => array( 'side', 'combo' ),
			'blurb' => '',
		),
	);

	/* --- تاپر و محافظ --- */
	$accessories = array(
		'titleA' => 'تاپر و محافظ',
		'titleB' => 'تشک',
		'desc'   => 'تاپر روی تشک قرار می‌گیرد و محافظ برای پوشاندن سطح تشک استفاده می‌شود.',
		'topper' => 'تاپر تشک هیگر',
		'topper_price' => '',
		'topper_features' => array(
			'لایه‌ای که روی تشک قرار می‌گیرد.',
			'مشخصات و ابعاد هر مدل را در فروشگاه بررسی کنید.',
		),
		'protector' => 'محافظ تشک هیگر',
		'protector_price' => '',
		'protector_features' => array(
			'برای پوشاندن سطح تشک استفاده می‌شود.',
			'جنس، ابعاد و شرایط شستشو را در صفحه محصول بررسی کنید.',
		),
		'sizes' => array( '۸۰×۱۸۰', '۹۰×۲۰۰', '۱۰۰×۲۰۰', '۱۲۰×۲۰۰', '۱۴۰×۲۰۰', '۱۶۰×۲۰۰', '۱۸۰×۲۰۰', '۲۰۰×۲۰۰' ),
		'guide' => array(
			array( 'q' => 'تاپر چیست؟', 'a' => 'تاپر لایه‌ای است که روی تشک قرار می‌گیرد. جنس و ضخامت آن به مدل بستگی دارد.' ),
			array( 'q' => 'محافظ تشک چه کاربردی دارد؟', 'a' => 'محافظ روی تشک قرار می‌گیرد. برای اطلاع از ویژگی‌های هر مدل، توضیحات محصول را بخوانید.' ),
			array( 'q' => 'چطور سایز مناسب را انتخاب کنم؟', 'a' => 'ابعاد تشک خود را اندازه بگیرید و با ابعاد محصول مقایسه کنید.' ),
		),
	);

	/* --- چرا هیگر؟ --- */
	$advantages = array(

	);

	/* --- سؤالات پرتکرار --- */
	$faqs = array(
		array( 'q' => 'تفاوت فنر متصل و فنر منفصل چیست؟', 'a' => 'در فنر متصل، فنرها به هم وصل‌اند. در فنر منفصل، هر فنر در یک پاکت جداگانه قرار می‌گیرد.' ),
		array( 'q' => 'ریباند چیست؟', 'a' => 'ریباند از قطعات فوم فشرده‌شده ساخته می‌شود. مشخصات هر مدل را در صفحه همان محصول بررسی کنید.' ),
		array( 'q' => 'تاپر و محافظ تشک چه کاربردی دارند؟', 'a' => 'تاپر و محافظ روی تشک قرار می‌گیرند. برای اطلاع از جنس و ویژگی‌های هر مدل، توضیحات محصول را ببینید.' ),
		array( 'q' => 'زمان شروع گارانتی تشک‌های هیگر؟', 'a' => 'از تاریخ ثبت فاکتور.' ),
		array( 'q' => 'چطور از زمان و هزینه ارسال مطلع شوم؟', 'a' => 'برای اطلاع از شرایط ارسال به شهر خود با فروشگاه تماس بگیرید.' ),
		array( 'q' => 'سایزهای موجود کدام‌اند؟', 'a' => '۷۰×۱۳۰ (نوزاد)، ۸۰×۱۸۰ (نوجوان)، ۹۰×۲۰۰ (یک‌نفره)، ۱۰۰×۲۰۰ (یک‌نفره)، ۱۲۰×۲۰۰ (یک‌نفره عریض)، ۱۴۰×۲۰۰ (دونفره)، ۱۶۰×۲۰۰ (کویین)، ۱۸۰×۲۰۰ (کینگ) و ۲۰۰×۲۰۰(سوپرکینگ). امکان دوخت سفارشی برای ابعاد خاص نیز وجود دارد.' ),
		array( 'q' => 'پرداخت چطور انجام می‌شود؟', 'a' => 'آنلاین با درگاه امن یا کارت‌به‌کارت.' ),
	);

	/* --- عکس‌ها — خالی بگذارید تا گرادیان سرمه‌ای نمایش داده شود.
	   مثال: 'hero' => 'https://higermattress.ir/wp-content/uploads/higer-home/hero.webp', --- */
	$images = array(
		'hero'    => 'https://higermattress.ir/wp-content/uploads/2026/11/higer-hero.webp',
		'factory' => 'https://higermattress.ir/wp-content/uploads/2026/11/higer-factory.webp',
		'topper'  => 'https://higermattress.ir/wp-content/uploads/2026/11/higer-topper.webp',
	);

	return compact( 'store', 'hero', 'marquee', 'cores', 'products', 'accessories', 'advantages', 'faqs', 'images' );
}
endif;


/* ============================================================
   بخش ۲ — موتور نمایش (معمولاً نیازی به دست‌زدن نیست)
   ============================================================ */

if ( ! function_exists( 'higer_core_diagram' ) ) {
	/**
	 * دیاگرام SVG مقطع هر هسته (شماتیک، بدون نیاز به عکس).
	 * @param string $core bonnell|pocket|rebond|foam
	 * @return string
	 */
	function higer_core_diagram( $core ) {
		if ( 'bonnell' === $core ) {
			$coils = '';
			foreach ( array( 14, 46, 78, 110, 142, 174 ) as $x ) {
				$coils .= '<g stroke="#e7b95c" stroke-width="2" fill="none"><path d="M ' . $x . ' 22 L ' . ($x+4) . ' 34 L ' . ($x+7) . ' 44 L ' . ($x+10) . ' 34 L ' . ($x+14) . ' 22" fill="rgba(217,161,59,0.12)"/><ellipse cx="' . ($x+7) . '" cy="22" rx="7.5" ry="2.6" fill="rgba(217,161,59,0.25)"/><ellipse cx="' . ($x+7) . '" cy="44" rx="7.5" ry="2.6" fill="rgba(217,161,59,0.25)"/></g>';
			}
			return '<svg viewBox="0 0 220 96" role="img" aria-label="مقطع فنر متصل"><line x1="6" y1="14" x2="214" y2="14" stroke="#f3d98b" stroke-width="3" stroke-linecap="round" opacity="0.9"/><line x1="6" y1="56" x2="214" y2="56" stroke="#f3d98b" stroke-width="3" stroke-linecap="round" opacity="0.9"/>' . $coils . '<text x="110" y="76" text-anchor="middle" fill="#f3d98b" font-size="10" font-weight="700" opacity="0.85">BONELL</text></svg>';
		}
		if ( 'pocket' === $core ) {
			$units = '';
			foreach ( array( 14, 46, 78, 110, 142, 174 ) as $x ) {
				$units .= '<g><rect x="' . $x . '" y="16" width="26" height="40" rx="8" fill="rgba(243,217,139,0.10)" stroke="#e7b95c" stroke-width="1.6"/><path d="M ' . ($x+6) . ' 24 C ' . ($x+20) . ' 28, ' . ($x+6) . ' 34, ' . ($x+20) . ' 38 C ' . ($x+6) . ' 42, ' . ($x+20) . ' 46, ' . ($x+6) . ' 50" fill="none" stroke="#d9a13b" stroke-width="1.8"/></g>';
			}
			return '<svg viewBox="0 0 220 96" role="img" aria-label="مقطع فنر منفصل"><rect x="6" y="8" width="208" height="56" rx="6" fill="none" stroke="#f3d98b" stroke-width="2" opacity="0.65" stroke-dasharray="5 4"/>' . $units . '<text x="110" y="80" text-anchor="middle" fill="#f3d98b" font-size="10" font-weight="700" opacity="0.85">POCKET</text></svg>';
		}
		if ( 'rebond' === $core ) {
			$dots = '';
			foreach ( array( array(18,22,6,'#d9a13b'),array(38,34,5,'#f3d98b'),array(52,18,4,'#8a6d3b'),array(66,40,6,'#d9a13b'),array(84,24,5,'#f3d98b'),array(98,44,4,'#a86f1c'),array(112,20,6,'#e7b95c'),array(128,36,5,'#8a6d3b'),array(142,22,4,'#d9a13b'),array(158,42,6,'#f3d98b'),array(172,26,5,'#a86f1c'),array(192,36,4,'#d9a13b') ) as $ch ) {
				$dots .= '<circle cx="' . $ch[0] . '" cy="' . $ch[1] . '" r="' . $ch[2] . '" fill="' . $ch[3] . '" opacity="0.9"/>';
			}
			return '<svg viewBox="0 0 220 96" role="img" aria-label="مقطع ریباند"><rect x="8" y="12" width="204" height="44" rx="7" fill="rgba(138,109,59,0.28)" stroke="#e7b95c" stroke-width="2"/>' . $dots . '<text x="110" y="76" text-anchor="middle" fill="#f3d98b" font-size="10" font-weight="700" opacity="0.85">REBOND</text></svg>';
		}
		return '<svg viewBox="0 0 220 96" role="img" aria-label="مقطع فوم سنگین"><path d="M8 18 C 60 10, 150 26, 212 16 L 212 34 C 150 44, 60 28, 8 38 Z" fill="rgba(91,122,78,0.4)" stroke="#a8c793" stroke-width="1.6"/><path d="M8 42 C 60 34, 150 50, 212 40 L 212 54 C 150 64, 60 48, 8 58 Z" fill="rgba(217,161,59,0.22)" stroke="#e7b95c" stroke-width="1.6"/><text x="110" y="86" text-anchor="middle" fill="#f3d98b" font-size="10" font-weight="700" opacity="0.85">DENSITY FOAM</text></svg>';
	}
}

if ( ! function_exists( 'higer_home_render' ) ) {
	/**
	 * خروجی کامل صفحه را برمی‌گرداند.
	 * @param array|string $atts
	 * @return string
	 */
	function higer_home_render( $atts = array() ) {
		/* تنظیمات از بخش ۱ */
		$cfg               = higer_home_config();
		$higer_store       = $cfg['store'];
		$higer_hero        = $cfg['hero'];
		$higer_marquee     = $cfg['marquee'];
		$higer_cores       = $cfg['cores'];
		$higer_products    = $cfg['products'];
		$higer_accessories = $cfg['accessories'];
		$higer_faqs        = $cfg['faqs'];
		$higer_images      = $cfg['images'];

		$defaults = array( 'fullwidth' => 'yes', 'only' => '' );
		$atts = is_array( $atts ) ? array_merge( $defaults, array_change_key_case( $atts, CASE_LOWER ) ) : $defaults;
		$fullwidth   = ! in_array( strtolower( (string) $atts['fullwidth'] ), array( 'no', '0', 'false', 'off' ), true );
		$only_finder = ( 'finder' === strtolower( (string) $atts['only'] ) );

		/* اعداد فارسی برای نمایش */
		$fa_plain = function( $n ) {
			return str_replace(
				array( '0','1','2','3','4','5','6','7','8','9' ),
				array( '۰','۱','۲','۳','۴','۵','۶','۷','۸','۹' ),
				(string) $n
			);
		};

		/* داده محصولات برای تشک‌سنج (جاوااسکریپت) */
		$js_products = array();
		foreach ( $higer_products as $p ) {
			$js_products[] = array(
				'id' => $p['id'], 'fa' => $p['fa'], 'en' => $p['en'], 'core' => $p['core'],
				'startPrice' => (int) $p['price'], 'firm' => (int) $p['firm'], 'support' => (int) $p['support'],
				'motion' => (int) $p['motion'], 'cooling' => (int) $p['cooling'], 'ortho' => (int) $p['ortho'],
				'idealMin' => (int) $p['min'], 'idealMax' => (int) $p['max'],
				'warranty' => (int) $p['warranty'], 'positions' => $p['pos'],
				'badge' => isset( $p['badge'] ) ? $p['badge'] : '', 'blurb' => $p['blurb'],
			);
		}
		$js_config = array(
			'shop' => $higer_store['shop'], 'phone' => $higer_store['phone'],
			'tel' => $higer_store['tel'], 'est' => $higer_store['est'], 'cores' => $higer_cores,
		);
		$json_flags = JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
		$js_products_json = wp_json_encode( $js_products, $json_flags );
		$js_config_json = wp_json_encode( $js_config, $json_flags );

		$count_fa = $fa_plain( count( $higer_products ) );
		$uid = 'hg-' . substr( md5( uniqid( 'higer', true ) ), 0, 6 );

		ob_start();
?>
<div class="higer-home" id="<?php echo esc_attr( $uid ); ?>" data-hg-fw="<?php echo $fullwidth ? 'yes' : 'no'; ?>">
<style>
/* ================== هیگر — استایل اسنیپت (نسخه بدون بیلد) ================== */
.higer-home{
  --hg-navy-950:#070f1d; --hg-navy-900:#10243e; --hg-navy-800:#183250;
  --hg-navy-700:#1f3e63; --hg-navy-600:#2b4e77;
  --hg-gold-600:#c8892a; --hg-gold-500:#d9a13b; --hg-gold-400:#e7b95c;
  --hg-gold-300:#f3d98b; --hg-gold-200:#f8ead0;
  --hg-cream:#faf7ef; --hg-paper:#f3efe3; --hg-line:#e3ddcd;
  font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;
  color:var(--hg-navy-900); background:var(--hg-cream);
  direction:rtl; text-align:right; font-size:16px; line-height:1.6;
  -webkit-font-smoothing:antialiased; text-rendering:optimizeLegibility;
}
.higer-home *,.higer-home *::before,.higer-home *::after{box-sizing:border-box}
.higer-home [id]{scroll-margin-top:110px}
.higer-home img{max-width:100%;height:auto}
.hg-wrap{max-width:80rem;margin-inline:auto;padding-inline:1rem}
@media(min-width:640px){.hg-wrap{padding-inline:1.5rem}}
.hg-sec{padding-block:4rem}
@media(min-width:1024px){.hg-sec{padding-block:6rem}}
.hg-paper{
  background-color:var(--hg-cream);
  background-image:radial-gradient(ellipse 80% 60% at 70% -10%,rgba(217,161,59,.14),transparent),radial-gradient(ellipse 60% 50% at 0% 110%,rgba(16,36,62,.08),transparent);
}
.hg-midnight{
  background:radial-gradient(1100px 520px at 85% -10%,rgba(217,161,59,.16),transparent 60%),radial-gradient(900px 600px at -15% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 45%,#16304f 100%);
}
.hg-grid-lines{background-image:linear-gradient(rgba(243,217,139,.055) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.055) 1px,transparent 1px);background-size:44px 44px}
.hg-kicker{display:inline-flex;align-items:center;gap:.5rem;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.7);padding:.35rem 1rem;border-radius:9999px;font-size:.65rem;font-weight:800;color:var(--hg-gold-600)}
.hg-kicker.on-dark{background:rgba(7,15,29,.55);color:var(--hg-gold-300);border-color:rgba(217,161,59,.4)}
.hg-h2{margin-top:1rem;font-size:1.7rem;font-weight:900;line-height:1.6;color:var(--hg-navy-900)}
@media(min-width:640px){.hg-h2{font-size:2.15rem}}
.hg-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.hg-lead{margin-top:.75rem;font-size:.85rem;line-height:2;color:var(--hg-navy-700);max-width:42rem}
.hg-btn-gold{position:relative;display:inline-flex;align-items:center;gap:.6rem;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:#10243e;font-weight:800;border-radius:9999px;box-shadow:0 10px 26px rgba(217,161,59,.38),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .25s ease,box-shadow .25s ease,filter .25s ease;overflow:hidden;border:none;cursor:pointer;text-decoration:none;padding:1rem 1.75rem;font-size:.85rem;font-family:inherit}
.hg-btn-gold:hover{transform:translateY(-2px);filter:brightness(1.04)}
.hg-btn-gold::after{content:"";position:absolute;top:-60%;inset-inline-start:-80%;width:55%;height:220%;background:linear-gradient(105deg,transparent,rgba(255,255,255,.75),transparent);transform:skewX(-18deg);animation:hg-shimmer 3.6s ease-in-out infinite;pointer-events:none}
@keyframes hg-shimmer{0%,55%{inset-inline-start:-90%}100%{inset-inline-start:140%}}
.hg-btn-outline{display:inline-flex;align-items:center;gap:.6rem;border:1px solid rgba(243,217,139,.4);color:var(--hg-gold-300);border-radius:9999px;transition:all .25s ease;text-decoration:none;padding:1rem 1.75rem;font-size:.85rem;font-weight:700}
.hg-btn-outline:hover{background:rgba(243,217,139,.1);border-color:rgba(243,217,139,.75)}
.hg-btn-dark{display:inline-flex;align-items:center;gap:.5rem;border-radius:9999px;background:var(--hg-navy-900);padding:.8rem 1.3rem;font-size:.72rem;font-weight:800;color:var(--hg-gold-300);text-decoration:none;border:none;cursor:pointer;font-family:inherit;transition:background .25s}
.hg-btn-dark:hover{background:var(--hg-navy-800)}
/* ---------- هیرو ---------- */
.hg-hero{position:relative;overflow:hidden;background:var(--hg-navy-950);color:var(--hg-cream)}
.hg-hero-bg{position:absolute;inset:0;background-size:cover;background-repeat:no-repeat;background-position:center 45%;background-color:#0b1a30}
.hg-hero-shade{position:absolute;inset:0;background:linear-gradient(to left,rgba(7,15,29,.95) 0%,rgba(7,15,29,.88) 36%,rgba(7,15,29,.52) 72%,rgba(7,15,29,.32) 100%)}
.hg-hero-inner{position:relative;padding-block:4rem 4rem}
@media(min-width:1024px){.hg-hero-inner{padding-block:6rem 7rem}}
.hg-hero h1{margin-top:1.25rem;font-size:2.3rem;font-weight:900;line-height:1.5;color:var(--hg-cream);text-shadow:0 2px 14px rgba(7,15,29,.55)}
@media(min-width:640px){.hg-hero h1{font-size:3rem}}
@media(min-width:1280px){.hg-hero h1{font-size:3.4rem}}
.hg-hero p.hg-hero-desc{margin-top:1.25rem;max-width:36rem;font-size:.92rem;line-height:2.1;color:rgba(248,234,208,.9)}
.hg-hero p.hg-hero-desc strong{color:var(--hg-gold-300)}
.hg-hero-cta{margin-top:1.75rem;display:flex;flex-wrap:wrap;align-items:center;gap:.75rem}
/* مارکی */
.hg-marquee{border-top:1px solid rgba(243,217,139,.18);background:rgba(7,15,29,.72);backdrop-filter:blur(6px);overflow:hidden;padding-block:.8rem;position:relative}
.hg-marquee-track{display:flex;gap:2.5rem;width:max-content;animation:hg-marquee 36s linear infinite}
.hg-marquee:hover .hg-marquee-track{animation-play-state:paused}
@keyframes hg-marquee{from{transform:translateX(0)}to{transform:translateX(50%)}}
.hg-marquee-track span{white-space:nowrap;font-size:.72rem;font-weight:700;color:var(--hg-gold-200);display:flex;align-items:center;gap:2.5rem}
.hg-marquee-track i{color:var(--hg-gold-500);font-style:normal}

/* Higer finder: original repository layout, standalone CSS. */
.higer-home .hf-root {
  position:relative; overflow:hidden; padding:64px 0; background:#f3efe3;
  color:#10243e; direction:rtl; text-align:right;
  font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;
  font-size:16px; line-height:1.5;
}
.hf-root *, .hf-root *::before, .hf-root *::after { box-sizing:border-box; }
.hf-root :is(h2,h3,h4,p,ul,ol,fieldset,legend) { margin:0; padding:0; border:0; }
.hf-root :is(ul,ol) { list-style:none; }
.hf-root button, .hf-root a, .hf-root input { font:inherit; color:inherit; }
.hf-root button { appearance:none; text-transform:none; letter-spacing:normal; cursor:pointer; box-shadow:none; }
.hf-root button::before, .hf-root button::after { content:none; }
.hf-root a { text-decoration:none; }
.hf-root fieldset { min-width:0; }
.hf-root svg { display:block; flex-shrink:0; vertical-align:middle; }
.hf-root [hidden] { display:none !important; }
.hf-root button:focus-visible, .hf-root a:focus-visible, .hf-root input:focus-visible { outline:3px solid #c8892a; outline-offset:4px; }
.hf-wrap { position:relative; max-width:1280px; margin:0 auto; padding:0 16px; }
.hf-glow { position:absolute; pointer-events:none; width:320px; height:320px; border-radius:50%; filter:blur(64px); }
.hf-glow-gold { right:-128px; top:40px; opacity:.2; background:radial-gradient(circle,#d9a13b,transparent 70%); }
.hf-glow-navy { left:-128px; bottom:40px; opacity:.15; background:radial-gradient(circle,#10243e,transparent 70%); }
.hf-heading { max-width:768px; margin:0 auto; text-align:center; }
.hf-heading .hf-eyebrow { display:inline-flex; align-items:center; gap:8px; border:1px solid #d9a13880; border-radius:9999px; padding:6px 16px; background:#ffffffb3; color:#c8892a; font-size:10px; font-weight:700; letter-spacing:.025em; }
.hf-heading h2 { margin-top:16px; font-size:30px; line-height:1.375; font-weight:900; color:#10243e; }
.hf-gold-text { background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%); background-clip:text; -webkit-background-clip:text; color:transparent; }
.hf-heading .hf-intro { margin-top:12px; font-size:14px; line-height:28px; color:#1f3e63; }
.hf-layout { display:grid; gap:24px; margin-top:48px; align-items:start; }
.hf-main { min-width:0; overflow:hidden; border:1px solid #e3ddcd; border-radius:24px; background:#fff; box-shadow:0 30px 70px rgba(16,36,62,.18); }
.hf-progress { padding:16px 20px; border-bottom:1px solid #e3ddcd; background:rgba(250,247,239,.6); }
.hf-progress-meta { display:flex; align-items:center; justify-content:space-between; font-size:11px; line-height:16.5px; font-weight:700; color:#183250; }
.hf-progress-track { margin-top:8px; height:8px; overflow:hidden; border-radius:9999px; background:#e3ddcd; }
.hf-progress-fill { height:100%; border-radius:inherit; background:linear-gradient(to left,#e7b95c,#d9a13b,#c8892a); transition:width .5s; }
.hf-steps { display:flex; align-items:center; justify-content:space-between; margin-top:12px !important; }
.hf-step { display:flex; flex-direction:column; align-items:center; gap:4px; }
.hf-step-circle { display:grid; place-items:center; width:24px; height:24px; border:0; border-radius:50%; background:#e3ddcd; color:#2b4e77; font-size:9px; font-weight:900; transition:all .3s; }
.hf-step.current .hf-step-circle { transform:scale(1.25); border:2px solid #d9a13b; background:#fff; color:#c8892a; }
.hf-step.done .hf-step-circle { background:#10243e; color:#e7b95c; }
.hf-step-label { display:none; font-size:8px; font-weight:700; color:rgba(43,78,119,.7); }
.hf-step.current .hf-step-label { color:#c8892a; }
.hf-form-body { padding:20px; }
.hf-question legend { display:table; font-size:18px; line-height:28px; font-weight:900; color:#10243e; }
.hf-question .hf-question-sub { margin-top:4px; font-size:12px; line-height:16px; color:#2b4e77; }
.hf-options { display:grid; gap:12px; margin-top:20px; }
.hf-root .hf-choice { display:flex; align-items:center; gap:16px; width:100%; padding:16px; border:1.5px solid #e3ddcd; border-radius:16px; background:#fffdf6; color:#10243e; text-align:right; transition:all .22s; }
.hf-root .hf-choice:hover { transform:translateY(-2px); border-color:rgba(217,161,59,.65); box-shadow:0 12px 26px rgba(16,36,62,.1); }
.hf-root .hf-choice[data-active="true"] { border-color:#d9a13b; background:linear-gradient(160deg,#fffdf3,#fdf3d8); box-shadow:0 12px 30px rgba(217,161,59,.28),inset 0 0 0 1px rgba(217,161,59,.4); }
.hf-choice-icon { display:grid; place-items:center; flex-shrink:0; width:56px; height:56px; border-radius:16px; background:#10243e; color:#e7b95c; }
.hf-choice-copy { display:block; }
.hf-choice-title { display:block; font-size:14px; line-height:20px; font-weight:900; color:#10243e; }
.hf-choice-sub { display:block; margin-top:2px; font-size:10px; line-height:16px; color:#2b4e77; }
.hf-root .hf-choice.position { flex-direction:column; gap:4px; text-align:center; }
.hf-choice.position .hf-choice-sub { margin-top:0; line-height:15px; }
.hf-position-glyph { width:80px; height:48px; color:#d9a13b; }
.hf-choice[data-active="true"] .hf-position-glyph { color:#10243e; }
.hf-options.compact { grid-template-columns:repeat(2,minmax(0,1fr)); }
.hf-root .hf-choice.compact { flex-direction:column; gap:8px; padding:16px 8px; text-align:center; color:#183250; }
.hf-choice.compact .hf-choice-title { font-size:11px; line-height:16.5px; }
.hf-root .hf-choice.sleeper { flex-direction:column; gap:8px; padding:20px; text-align:center; color:#183250; }
.hf-choice.sleeper .hf-choice-title { font-size:12px; line-height:16px; }
.hf-choice.sleeper .hf-choice-sub { margin-top:0; font-size:9px; }
.hf-note { display:flex; align-items:flex-start; gap:8px; margin-top:12px !important; padding:12px; border:1px solid #d9a13b66; border-radius:12px; background:#f8ead04d; font-size:10px; line-height:20px; color:#183250; }
.hf-note svg { margin-top:2px; color:#c8892a; }
.hf-range-stack { display:grid; gap:24px; margin-top:24px; }
.hf-range-box { padding:16px; border:1px solid #e3ddcd; border-radius:16px; background:rgba(250,247,239,.5); }
.hf-range-head { display:flex; align-items:center; justify-content:space-between; gap:12px; }
.hf-range-head label { display:flex; align-items:center; gap:8px; font-size:12px; line-height:16px; font-weight:700; color:#183250; }
.hf-range-head label svg { color:#c8892a; }
.hf-range-head output { font-size:24px; line-height:32px; font-weight:900; color:#10243e; }
.hf-range-head small { font-size:10px; line-height:15px; font-weight:700; color:#2b4e77; }
.hf-root .hf-range { appearance:none; -webkit-appearance:none; display:inline-block; width:100%; height:8px; margin:12px 0 0; padding:0; border:0; border-radius:9999px; background:linear-gradient(to left,#d9a13b var(--fill,50%),#e6e0cf var(--fill,50%)); outline:none; cursor:pointer; }
.hf-range::-webkit-slider-thumb { appearance:none; -webkit-appearance:none; width:26px; height:26px; border:3px solid #10243e; border-radius:50%; background:radial-gradient(circle at 35% 35%,#fbe9bf,#d9a13b 70%); box-shadow:0 3px 10px rgba(16,36,62,.4); transition:transform .15s; }
.hf-range::-webkit-slider-thumb:hover { transform:scale(1.18); }
.hf-range::-moz-range-thumb { width:24px; height:24px; border:3px solid #10243e; border-radius:50%; background:radial-gradient(circle at 35% 35%,#fbe9bf,#d9a13b 70%); box-shadow:0 3px 10px rgba(16,36,62,.4); }
.hf-range-ticks { display:flex; justify-content:space-between; margin-top:4px; font-size:9px; line-height:13.5px; font-weight:700; color:rgba(43,78,119,.7); }
.hf-inline-bmi { display:flex; flex-direction:column; gap:12px; padding:16px; border:1px solid #10243e1a; border-radius:16px; background:#10243e; color:#faf7ef; }
.hf-inline-bmi-main { display:flex; align-items:center; gap:12px; }
.hf-scale-icon { display:grid; place-items:center; width:48px; height:48px; border-radius:12px; background:#d9a13b; color:#10243e; }
.hf-inline-bmi-main small { display:block; font-size:10px; font-weight:700; color:#f3d98b; }
.hf-inline-bmi-main b { display:block; font-size:24px; line-height:32px; font-weight:900; color:#fff; text-align:right; }
.hf-bmi-detail { width:100%; }
.hf-bmi-badge { display:inline-block; padding:4px 12px; border:1px solid; border-radius:9999px; font-size:10px; line-height:15px; font-weight:900; }
.hf-bmi-badge.ok { background:#d1fae5; color:#065f46; border-color:#6ee7b7; }
.hf-bmi-badge.warn { background:#fef3c7; color:#78350f; border-color:#fcd34d; }
.hf-bmi-badge.high { background:#fee2e2; color:#991b1b; border-color:#fca5a5; }
.hf-bmi-badge.low { background:#e0f2fe; color:#075985; border-color:#7dd3fc; }
.hf-bmi-track { height:8px; margin-top:8px; overflow:hidden; border-radius:9999px; background:#ffffff26; }
.hf-bmi-fill { height:100%; border-radius:inherit; background:linear-gradient(to left,#f3d98b,#d9a13b); transition:width .3s; }
.hf-bmi-detail p { margin-top:6px; font-size:9px; line-height:13.5px; color:#faf7ef99; }
.hf-firmness { display:grid; grid-template-columns:repeat(5,minmax(0,1fr)); gap:8px; margin-top:24px; }
.hf-root .hf-firm-choice { display:flex; flex-direction:column; align-items:center; gap:8px; padding:16px 0; border:2px solid #e3ddcd; border-radius:16px; background:#fff; transition:all .22s; }
.hf-root .hf-firm-choice:hover { border-color:#e7b95c; }
.hf-root .hf-firm-choice[aria-checked="true"] { border-color:#d9a13b; background:linear-gradient(to bottom,#f8ead0b3,#f8ead033); box-shadow:0 10px 24px #d9a13b59; }
.hf-firm-choice b { display:grid; place-items:center; width:36px; height:36px; border-radius:50%; background:#f3efe3; color:#183250; font-size:14px; line-height:20px; font-weight:900; }
.hf-firm-choice[aria-checked="true"] b { background:#10243e; color:#e7b95c; }
.hf-firm-choice span { font-size:9px; line-height:16px; font-weight:900; color:#10243e; }
.hf-firm-hint { margin-top:12px !important; font-size:10px; line-height:15px; font-weight:700; color:#2b4e77; text-align:center; }
.hf-root .hf-choice.budget { gap:12px; }
.hf-budget-number { display:grid; place-items:center; width:48px; height:48px; flex-shrink:0; border-radius:12px; background:#f3efe3; color:#183250; font-size:18px; line-height:28px; font-weight:900; }
.hf-choice[data-active="true"] .hf-budget-number { background:#10243e; color:#e7b95c; }
.hf-choice.budget .hf-choice-title { font-size:12px; line-height:16px; }
.hf-choice.budget .hf-choice-sub { font-size:9px; line-height:13.5px; }
.hf-nav { display:flex; align-items:center; justify-content:space-between; gap:12px; margin-top:28px; padding-top:20px; border-top:1px solid #e3ddcd; }
.hf-root .hf-prev, .hf-root .hf-restart, .hf-root .hf-compare-toggle { display:inline-flex; align-items:center; gap:6px; padding:12px 20px; border:1px solid #e3ddcd; border-radius:9999px; background:transparent; color:#183250; font-size:12px; line-height:16px; font-weight:700; transition:background .2s; }
.hf-root .hf-prev:hover, .hf-root .hf-restart:hover { background:#f3efe3; }
.hf-root .hf-prev:disabled { opacity:0; cursor:default; pointer-events:none; }
.hf-nav-hint { display:none; font-size:10px; line-height:15px; font-weight:700; color:#b45309; }
.hf-root .hf-next { display:inline-flex; align-items:center; gap:8px; padding:12px 24px; border:0; border-radius:9999px; background:#10243e; color:#f3d98b; font-size:12px; line-height:16px; font-weight:900; transition:background .2s,transform .2s; }
.hf-root .hf-next:hover:not(:disabled) { background:#183250; }
.hf-root .hf-next:disabled { cursor:not-allowed; opacity:.4; }
.hf-root .hf-next.final { position:relative; overflow:hidden; background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%); color:#10243e; box-shadow:0 10px 26px #d9a13b61,inset 0 1px 0 #ffffffbf; }
.hf-root .hf-next.final:hover:not(:disabled) { transform:translateY(-2px); filter:brightness(1.04); }
.hf-aside { display:none; min-width:0; }
.hf-aside-sticky { position:sticky; top:112px; display:grid; gap:16px; }
.hf-body-card { overflow:hidden; border:1px solid #183250; border-radius:24px; background:#10243e; color:#faf7ef; box-shadow:0 24px 50px #070f1d59; }
.hf-body-card-header { display:flex; align-items:center; justify-content:space-between; gap:8px; padding:12px 20px; border-bottom:1px solid #ffffff1a; background:#ffffff0d; }
.hf-body-card-header p { display:flex; align-items:center; gap:8px; font-size:12px; line-height:16px; font-weight:900; color:#f3d98b; }
.hf-body-card-header > span { padding:4px 10px; border-radius:9999px; background:#d9a13b26; color:#f3d98b; font-size:9px; font-weight:700; white-space:nowrap; }
.hf-body-metrics { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); padding:20px; text-align:center; }
.hf-body-metrics > div:first-child { border-right:1px solid #ffffff1a; }
.hf-body-metrics small { display:block; font-size:10px; line-height:15px; font-weight:700; color:#faf7ef99; }
.hf-body-metrics b { display:block; margin-top:4px; font-size:30px; line-height:36px; font-weight:900; color:#fff; }
.hf-body-metrics span { display:block; font-size:9px; line-height:13.5px; color:#faf7ef80; }
.hf-body-summary { padding:16px 20px; border-top:1px solid #ffffff1a; }
.hf-summary-bmi { display:flex; align-items:center; justify-content:space-between; font-size:10px; font-weight:700; color:#faf7efb3; }
.hf-summary-bmi b { color:#f3d98b; }
.hf-body-summary .hf-bmi-fill { background:linear-gradient(to left,#f3d98b,#c8892a); }
.hf-summary-answers { display:grid; gap:6px; margin-top:16px !important; font-size:10px; line-height:20px; }
.hf-summary-answers li { display:flex; align-items:center; justify-content:space-between; gap:8px; padding-bottom:6px; border-bottom:1px solid #ffffff0d; }
.hf-summary-answers span { color:#faf7ef80; }
.hf-summary-answers b { color:#f8ead0; font-weight:900; }
.hf-trust { padding:20px; border:1px solid #e3ddcd; border-radius:24px; background:#fff; box-shadow:0 1px 2px #0000000d; }
.hf-avatars { display:flex; }
.hf-avatars span { display:grid; place-items:center; width:36px; height:36px; border:2px solid #fff; border-radius:50%; background:#10243e; color:#f3d98b; font-size:11px; font-weight:900; text-align:center; }
.hf-avatars span:not(:last-child) { margin-right:-8px; }
.hf-avatars span:last-child { font-size:9px; line-height:13.5px; color:#10243e; background:#d9a13b; }
.hf-trust .hf-trust-title { margin-top:12px; font-size:11px; line-height:20px; font-weight:900; color:#10243e; }
.hf-trust .hf-trust-desc { margin-top:4px; font-size:9px; line-height:20px; color:#2b4e77; }
.hf-trust .hf-human { display:flex; align-items:center; justify-content:center; gap:8px; margin-top:12px; padding:10px 8px; border:1px solid #10243e26; border-radius:12px; background:#faf7ef; color:#10243e; font-size:10px; font-weight:900; transition:border-color .2s; }
.hf-trust .hf-human:hover { border-color:#d9a13b; }
.hf-results-head { display:flex; flex-direction:column; align-items:flex-start; justify-content:space-between; gap:12px; }
.hf-results-head h3 { font-size:20px; line-height:28px; font-weight:900; color:#10243e; }
.hf-results-head p { margin-top:4px; font-size:11px; line-height:16.5px; color:#2b4e77; }
.hf-root .hf-restart { flex-shrink:0; padding:8px 16px; font-size:11px; line-height:16.5px; }
.hf-results-list { display:grid; gap:16px; margin-top:20px; }
.hf-result { position:relative; overflow:hidden; padding:16px; border:2px solid #e3ddcd; border-radius:16px; background:#fff; }
.hf-result.best { border-color:#d9a13b; background:linear-gradient(to left,#f8ead066,#fffdf4,#fff); box-shadow:0 18px 44px #d9a13b47; }
.hf-result-best { position:absolute; left:0; top:0; display:flex; align-items:center; gap:4px; padding:6px 12px; border-bottom-right-radius:16px; background:#10243e; color:#e7b95c; font-size:9px; font-weight:900; }
.hf-result-best svg { fill:currentColor; }
.hf-result-row { display:flex; flex-direction:column; gap:16px; }
.hf-ring { position:relative; width:96px; height:96px; flex-shrink:0; }
.hf-ring > svg { width:100%; height:100%; transform:rotate(-90deg); }
.hf-ring-label { position:absolute; inset:0; display:flex; flex-direction:column; justify-content:center; align-items:center; }
.hf-ring-label b { font-size:20px; line-height:20px; font-weight:900; color:#10243e; }
.hf-ring-label span { margin-top:2px; font-size:8px; font-weight:700; color:#2b4e77; }
.hf-result-content { flex:1; min-width:0; }
.hf-result-title { display:flex; flex-wrap:wrap; align-items:center; gap:8px; }
.hf-result-title h4 { font-size:18px; line-height:28px; font-weight:900; color:#10243e; }
.hf-result-en { font-size:9px; font-weight:700; letter-spacing:.1em; color:#3a6189; }
.hf-core-tag { display:inline-flex; align-items:center; gap:4px; padding:2px 10px; border-radius:9999px; background:#10243e; color:#f3d98b; font-size:9px; font-weight:700; }
.hf-core-tag i { width:6px; height:6px; border-radius:50%; }
.hf-product-badge { padding:2px 10px; border-radius:9999px; background:#d9a13b33; color:#c8892a; font-size:9px; font-weight:700; }
.hf-result .hf-blurb { margin-top:6px; font-size:10px; line-height:20px; color:#1f3e63; }
.hf-specs { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; margin-top:12px; }
.hf-spec-head { display:flex; justify-content:space-between; align-items:center; gap:4px; margin-bottom:4px; font-size:10px; font-weight:700; color:#183250; }
.hf-spec-track { height:6px; overflow:hidden; border-radius:9999px; background:#f3efe3; }
.hf-spec-fill { height:100%; border-radius:inherit; background:linear-gradient(to left,#d9a13b,#c8892a); transform-origin:right center; animation:hf-bar-grow .9s cubic-bezier(.22,1,.36,1) both; }
.hf-reasons { display:grid; gap:4px; margin-top:12px !important; }
.hf-reasons li { display:flex; align-items:flex-start; gap:6px; font-size:9px; line-height:20px; color:#1f3e63; }
.hf-reasons svg { margin-top:2px; color:#059669; }
.hf-price-cta { display:flex; flex-direction:row; align-items:center; justify-content:space-between; flex-shrink:0; gap:12px; padding-top:12px; border-top:1px solid #e3ddcd; }
.hf-price-cta p { font-size:9px; font-weight:700; color:#2b4e77; }
.hf-price-cta .hf-price { font-size:14px; line-height:20px; font-weight:900; color:#10243e; white-space:nowrap; }
.hf-warranty { display:inline-flex; align-items:center; gap:4px; margin-top:2px; padding:2px 8px; border-radius:9999px; background:#ecfdf5; color:#047857; font-size:8px; font-weight:700; }
.hf-price-cta .hf-order { display:inline-flex; align-items:center; gap:4px; padding:8px 16px; border-radius:9999px; background:#10243e; color:#f3d98b; font-size:10px; font-weight:900; }
.hf-price-cta .hf-order:hover { background:#183250; }
.hf-comparison { margin-top:16px; }
.hf-root .hf-compare-toggle { gap:8px; padding:8px 16px; border-color:#10243e33; color:#10243e; font-size:10px; line-height:15px; font-weight:900; }
.hf-root .hf-compare-toggle:hover { background:#faf7ef; }
.hf-table-wrap { margin-top:12px; overflow-x:auto; border:1px solid #e3ddcd; border-radius:16px; }
.hf-table { width:100%; min-width:560px; border-collapse:collapse; border-spacing:0; text-align:center; font-size:10px; color:#10243e; background:#fff; }
.hf-table thead { background:#10243e; color:#f3d98b; }
.hf-table th { padding:12px; font-weight:900; }
.hf-table td { padding:10px; font-weight:700; border-bottom:1px solid #e3ddcd; }
.hf-table a { color:#1f3e63; text-decoration:underline; text-underline-offset:3px; }
.hf-table a:hover { color:#c8892a; }
.hf-table th:first-child,.hf-table td:first-child { text-align:right; }
.hf-table tbody tr:last-child td { border-bottom:0; }
.hf-extras { display:grid; gap:8px; margin-top:16px; }
.hf-extra { display:flex; align-items:center; gap:12px; padding:12px; border:1px solid #d9a13b80; border-radius:16px; background:linear-gradient(to left,#f8ead066,#fff); transition:border-color .2s; }
.hf-extra:hover { border-color:#d9a13b; }
.hf-extra-icon { display:grid; place-items:center; width:44px; height:44px; flex-shrink:0; border-radius:12px; background:#10243e; color:#e7b95c; }
.hf-extra:last-child .hf-extra-icon { background:#d9a13b; color:#10243e; }
.hf-extra b { display:block; font-size:9px; line-height:13.5px; font-weight:900; color:#10243e; }
.hf-extra small { display:block; margin-top:2px; font-size:8px; line-height:16px; color:#2b4e77; }
.hf-extra u { color:#c8892a; }
.hf-contact-note { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:8px; margin-top:16px !important; padding:12px; border-radius:12px; background:#faf7ef; font-size:9px; line-height:20px; color:#1f3e63; }
.hf-contact-note a { display:inline-flex; align-items:center; gap:4px; font-weight:900; color:#10243e; text-decoration:underline; text-decoration-color:#d9a13b; text-decoration-thickness:2px; text-underline-offset:2px; }
.hf-enter { animation:hf-fade-up .55s cubic-bezier(.22,1,.36,1) both; }
.hf-ring-anim { animation:hf-ring-in 1.15s cubic-bezier(.22,1,.36,1) both; }
@keyframes hf-fade-up { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:translateY(0); } }
@keyframes hf-bar-grow { from { transform:scaleX(0); } }
@keyframes hf-ring-in { from { stroke-dashoffset:var(--ring-c); } }
@media(min-width:640px) {
  .hf-wrap { padding:0 24px; }
  .hf-heading h2 { font-size:36px; line-height:1.375; }
  .hf-progress { padding:16px 28px; }
  .hf-step-circle { width:28px; height:28px; font-size:10px; }
  .hf-step-label { display:block; }
  .hf-form-body { padding:28px; }
  .hf-options.two { grid-template-columns:repeat(2,minmax(0,1fr)); }
  .hf-options.three,.hf-options.compact { grid-template-columns:repeat(3,minmax(0,1fr)); }
  .hf-inline-bmi { flex-direction:row; align-items:center; justify-content:space-between; }
  .hf-bmi-detail { width:224px; }
  .hf-firm-choice span { font-size:10px; }
  .hf-nav-hint { display:block; }
  .hf-results-head { flex-direction:row; align-items:center; }
  .hf-result { padding:20px; }
  .hf-result-row { flex-direction:row; align-items:center; }
  .hf-price-cta { width:160px; flex-direction:column; align-items:flex-end; justify-content:center; padding-top:0; border:0; }
  .hf-price-cta > div { text-align:left; }
  .hf-extras { grid-template-columns:repeat(2,minmax(0,1fr)); }
}
@media(min-width:1024px) {
  .higer-home .hf-root { padding:96px 0; }
  .hf-layout { grid-template-columns:repeat(12,minmax(0,1fr)); }
  .hf-main { grid-column:span 8; }
  .hf-aside { display:block; grid-column:span 4; align-self:stretch; }
}
@media(prefers-reduced-motion:reduce) {
  .hf-root *, .hf-root *::before, .hf-root *::after { animation:none !important; transition:none !important; scroll-behavior:auto !important; }
}

/* ---------- کارت‌ها ---------- */
.hg-cards{display:grid;gap:1.25rem;margin-top:2.5rem}
@media(min-width:768px){.hg-cards.cols-4{grid-template-columns:repeat(2,1fr)}}
@media(min-width:1200px){.hg-cards.cols-4{grid-template-columns:repeat(4,1fr)}}
.hg-card{background:#fffdf6;border:1px solid var(--hg-line);box-shadow:0 2px 10px rgba(16,36,62,.05);transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;border-radius:1.5rem;overflow:hidden;display:flex;flex-direction:column}
.hg-card:hover{transform:translateY(-5px);box-shadow:0 22px 48px rgba(16,36,62,.16);border-color:rgba(217,161,59,.55)}
.hg-card-art{position:relative;height:9rem;overflow:hidden;background:var(--hg-navy-900);padding:1rem}
.hg-card-art svg{height:100%;width:100%;transition:transform .5s ease}
.hg-card:hover .hg-card-art svg{transform:scale(1.06)}
.hg-card-art .hg-num{position:absolute;right:.75rem;top:.5rem;font-size:3rem;font-weight:900;color:rgba(255,255,255,.06)}
.hg-card-art .hg-en-tag{position:absolute;left:.75rem;top:.75rem;border:1px solid rgba(217,161,59,.4);background:rgba(217,161,59,.1);padding:.2rem .6rem;border-radius:9999px;font-size:.5rem;font-weight:900;letter-spacing:.15em;color:var(--hg-gold-300)}
.hg-card-body{padding:1.25rem;display:flex;flex:1;flex-direction:column}
.hg-card-body h3{font-size:1.2rem;font-weight:900;color:var(--hg-navy-900)}
.hg-card-body .hg-short{margin-top:.5rem;font-size:.7rem;line-height:1.9;color:var(--hg-navy-700)}
.hg-card-foot{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:.5rem;border-top:1px solid var(--hg-line);padding-top:1rem}
.hg-mini-btn{border-radius:9999px;border:1px solid var(--hg-navy-900);background:var(--hg-navy-900);padding:.5rem 1rem;font-size:.62rem;font-weight:800;color:var(--hg-gold-300);cursor:pointer;font-family:inherit;text-decoration:none;display:inline-block}
.hg-mini-btn:hover{background:var(--hg-gold-500);color:var(--hg-navy-900);border-color:var(--hg-gold-500)}
/* جانبی */
.hg-acc-grid{display:grid;gap:1.5rem;margin-top:2.5rem}
@media(min-width:1024px){.hg-acc-grid{grid-template-columns:repeat(12,1fr)}}
@media(min-width:1024px){.hg-acc-fig{grid-column:span 4}.hg-acc-card{grid-column:span 4}}
.hg-acc-fig{position:relative;overflow:hidden;border-radius:1.5rem;border:1px solid var(--hg-line);min-height:17rem;box-shadow:0 24px 55px rgba(16,36,62,.22);margin:0}
.hg-acc-fig img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
.hg-acc-fig .hg-acc-shade{position:absolute;inset:0;background:linear-gradient(to top,rgba(7,15,29,.85),rgba(7,15,29,.15),transparent)}
.hg-acc-fig figcaption{position:absolute;bottom:1rem;right:1rem;left:1rem}
.hg-acc-fig figcaption small{font-size:.6rem;font-weight:700;letter-spacing:.2em;color:var(--hg-gold-400)}
.hg-acc-fig figcaption p{font-size:.85rem;font-weight:900;color:#fff}
.hg-feat{list-style:none;padding:0;margin:.9rem 0;display:grid;gap:.55rem;font-size:.68rem;line-height:1.9;color:var(--hg-navy-700)}
.hg-feat li{display:flex;gap:.5rem}
.hg-feat li i{color:var(--hg-gold-600);font-style:normal;font-weight:900}
/* آکاردئون */
.hg-acc{border:1px solid var(--hg-line);border-radius:1rem;background:#fffdf6;margin-top:.6rem;overflow:hidden}
.hg-acc summary{cursor:pointer;padding:.9rem 1.1rem;font-size:.78rem;font-weight:800;color:var(--hg-navy-900);list-style:none;display:flex;justify-content:space-between;align-items:center;gap:1rem}
.hg-acc summary::-webkit-details-marker{display:none}
.hg-acc summary::after{content:"+";flex-shrink:0;width:1.6rem;height:1.6rem;display:grid;place-items:center;border-radius:50%;background:var(--hg-paper);color:var(--hg-gold-600);font-weight:900;transition:transform .25s}
.hg-acc[open] summary::after{transform:rotate(45deg);background:var(--hg-gold-500);color:var(--hg-navy-900)}
.hg-acc .hg-acc-body{padding:0 1.1rem 1rem;font-size:.72rem;line-height:2.1;color:var(--hg-navy-700)}
/* مزایا + کارخانه */
.hg-why{display:grid;gap:2.5rem;align-items:center}
@media(min-width:1024px){.hg-why{grid-template-columns:5fr 7fr}}
.hg-why figure{margin:0;overflow:hidden;border-radius:1.5rem;border:1px solid var(--hg-line);box-shadow:0 30px 60px rgba(16,36,62,.25)}
.hg-why figure img{display:block;width:100%;height:100%;object-fit:cover;min-height:16rem}
/* شناور */
.hg-float{position:fixed;bottom:1.25rem;left:1rem;z-index:50;display:flex;flex-direction:column;align-items:center;gap:.5rem}
@media(min-width:640px){.hg-float{left:1.5rem}}
.hg-to-top{display:none;width:3rem;height:3rem;place-items:center;border-radius:1rem;border:1px solid var(--hg-line);background:rgba(255,255,255,.9);color:var(--hg-navy-900);box-shadow:0 10px 24px rgba(16,36,62,.25);cursor:pointer;font-size:1.1rem}
.hg-to-top.show{display:grid}
.hg-call{position:relative;width:4rem;height:4rem;display:grid;place-items:center;border-radius:1.1rem;background:var(--hg-gold-500);color:var(--hg-navy-900);box-shadow:0 14px 34px rgba(217,161,59,.45);text-decoration:none;font-size:1.5rem;transition:transform .2s}
.hg-call:hover{transform:scale(1.05)}
.hg-call::after{content:"";position:absolute;top:-.3rem;right:-.3rem;width:1.1rem;height:1.1rem;border-radius:50%;background:#10b981;border:2px solid var(--hg-cream);animation:hg-pulse 2.1s infinite}
@keyframes hg-pulse{0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.5)}60%{box-shadow:0 0 0 8px rgba(16,185,129,0)}}
@keyframes hg-fade-up{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
.hg-fade-up{animation:hg-fade-up .55s cubic-bezier(.22,1,.36,1) both}
@media(prefers-reduced-motion:reduce){.higer-home *,.higer-home *::before,.higer-home *::after{animation-duration:.01ms!important;transition-duration:.01ms!important}}
</style>
<!-- ===== هیرو ===== -->
<?php if ( ! $only_finder ) : ?>
<section class="hg-hero" id="hg-top">
	<div class="hg-hero-bg"<?php if ( ! empty( $higer_images['hero'] ) ) : ?> style="background-image:url('<?php echo esc_url( $higer_images['hero'] ); ?>')"<?php endif; ?>></div>
	<div class="hg-hero-shade"></div>
	<div class="hg-wrap hg-hero-inner">
		<span class="hg-kicker on-dark"><?php echo esc_html( $higer_hero['badge'] ); ?> • از سال <?php echo esc_html( $higer_store['est'] ); ?></span>
		<h1><?php echo esc_html( $higer_hero['titleA'] ); ?><br><span class="hg-gold-text"><?php echo esc_html( $higer_hero['titleB'] ); ?></span></h1>
		<p class="hg-hero-desc"><?php echo esc_html( $higer_hero['desc'] ); ?></p>
		<div class="hg-hero-cta">
			<a href="#hg-finder" class="hg-btn-gold">☾ <?php echo esc_html( $higer_hero['cta1'] ); ?></a>
			<a href="<?php echo esc_url( $higer_store['tel'] ); ?>" class="hg-btn-outline">☎ <?php echo esc_html( $higer_hero['cta2'] ); ?> — <?php echo esc_html( $higer_store['phone'] ); ?></a>
		</div>
	</div>
	<div class="hg-marquee"><div class="hg-marquee-track"><?php foreach ( array_merge( $higer_marquee, $higer_marquee ) as $m ) : ?><span><?php echo esc_html( $m ); ?> <i>◆</i></span><?php endforeach; ?></div></div>
</section>
<?php endif; ?>

<!-- ===== تشک‌سنج هوشمند ===== -->

<section class="hg-finder hf-root" id="hg-finder" dir="rtl" lang="fa" aria-label="تشک‌سنج هوشمند هیگر">
  <div class="hf-glow hf-glow-gold" aria-hidden="true"></div>
  <div class="hf-glow hf-glow-navy" aria-hidden="true"></div>
  <div class="hf-wrap">
    <header class="hf-heading">
      <p class="hf-eyebrow"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"></path><path d="M20 2v4"></path><path d="M22 4h-4"></path><circle cx="4" cy="20" r="2"></circle></svg> راهنمای انتخاب تشک هیگر</p>
      <h2>کدام تشک <span class="hf-gold-text">برای شما مناسب است؟</span></h2>
      <p class="hf-intro">به چند سؤال درباره شرایط و سلیقه خود پاسخ دهید تا از میان <?php echo $count_fa; ?> مدل ثبت‌شده، چند گزینه پیشنهادی ببینید.</p>
    </header>
    <div class="hf-layout" data-hg-finder>
      <noscript>برای استفاده از تشک‌سنج هوشمند، جاوااسکریپت مرورگر را فعال کنید.</noscript>
    </div>
  </div>
</section>

<?php if ( ! $only_finder ) : ?>
<!-- ===== ۴ هسته تشک ===== -->
<section class="hg-paper hg-sec" id="hg-cores">
	<div class="hg-wrap">
		<span class="hg-kicker">انواع هسته تشک</span>
		<h2 class="hg-h2">با انواع <span class="hg-gold-text">تشک آشنا شوید</span></h2>
		<p class="hg-lead">هسته تشک یکی از ویژگی‌هایی است که می‌توانید هنگام انتخاب مدل بررسی کنید.</p>
		<div class="hg-cards cols-4">
			<?php $ci = 0; foreach ( $higer_cores as $core ) : $ci++; ?>
			<article class="hg-card">
				<div class="hg-card-art"><span class="hg-num"><?php echo $fa_plain( str_pad( (string) $ci, 2, '0', STR_PAD_LEFT ) ); ?></span>
					<?php echo higer_core_diagram( $core['key'] ); // دیاگرام SVG مقطع هسته ?>
					<span class="hg-en-tag"><?php echo esc_html( strtoupper( (string) $core['en'] ) ); ?></span>
				</div>
				<div class="hg-card-body">
					<h3><?php echo esc_html( $core['fa'] ); ?></h3>
					<p class="hg-short"><?php echo esc_html( $core['short'] ); ?></p>
					<div class="hg-card-foot">
						<a class="hg-mini-btn" href="<?php echo esc_url( rtrim( $higer_store['shop'], '/' ) . $core['category_path'] ); ?>" target="_blank" rel="noopener noreferrer">مشاهده در فروشگاه ↗</a>
					</div>
				</div>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ===== تاپر و محافظ ===== -->
<section class="hg-paper hg-sec" id="hg-accessories">
	<div class="hg-wrap">
		<span class="hg-kicker">⧉ محصولات جانبی هیگر</span>
		<h2 class="hg-h2"><?php echo esc_html( $higer_accessories['titleA'] ); ?> <span class="hg-gold-text"><?php echo esc_html( $higer_accessories['titleB'] ); ?></span></h2>
		<p class="hg-lead"><?php echo esc_html( $higer_accessories['desc'] ); ?></p>
		<div class="hg-acc-grid">
			<figure class="hg-acc-fig">
				<?php if ( ! empty( $higer_images['topper'] ) ) : ?><img src="<?php echo esc_url( $higer_images['topper'] ); ?>" alt="تاپر و محافظ تشک هیگر" loading="lazy"><?php else : ?><div class="hg-midnight hg-grid-lines" style="position:absolute;inset:0"></div><?php endif; ?>
				<div class="hg-acc-shade"></div>
				<figcaption><small>HIGER ACCESSORIES</small><p>تاپر و محافظ تشک هیگر</p></figcaption>
			</figure>
			<article class="hg-card hg-acc-card"><div class="hg-card-body">
				<h3><?php echo esc_html( $higer_accessories['topper'] ); ?></h3>
				<?php if ( ! empty( $higer_accessories['topper_price'] ) ) : ?><p style="font-size:.7rem;font-weight:800;color:#c8892a;margin:.2rem 0 0"><?php echo esc_html( $higer_accessories['topper_price'] ); ?></p><?php endif; ?>
				<ul class="hg-feat"><?php foreach ( $higer_accessories['topper_features'] as $t ) : ?><li><i>✔</i><span><?php echo esc_html( $t ); ?></span></li><?php endforeach; ?></ul>
				<a class="hg-mini-btn" style="margin-top:.9rem;text-align:center" href="<?php echo esc_url( $higer_store['shop'] . '/?s=' . rawurlencode( 'تاپر' ) . '&post_type=product' ); ?>" target="_blank" rel="noopener">دیدن تاپرها در فروشگاه ↗</a>
			</div></article>
			<article class="hg-card hg-acc-card"><div class="hg-card-body">
				<h3><?php echo esc_html( $higer_accessories['protector'] ); ?></h3>
				<?php if ( ! empty( $higer_accessories['protector_price'] ) ) : ?><p style="font-size:.7rem;font-weight:800;color:#c8892a;margin:.2rem 0 0"><?php echo esc_html( $higer_accessories['protector_price'] ); ?></p><?php endif; ?>
				<ul class="hg-feat"><?php foreach ( $higer_accessories['protector_features'] as $t ) : ?><li><i>✔</i><span><?php echo esc_html( $t ); ?></span></li><?php endforeach; ?></ul>
				<a class="hg-mini-btn" style="margin-top:.9rem;text-align:center" href="<?php echo esc_url( $higer_store['shop'] . '/?s=' . rawurlencode( 'محافظ تشک' ) . '&post_type=product' ); ?>" target="_blank" rel="noopener">دیدن محافظ‌ها در فروشگاه ↗</a>
			</div></article>
		</div>
		<div style="margin-top:1.5rem;max-width:52rem"><h3 style="font-size:1rem;font-weight:900;margin-bottom:.5rem">راهنمای سریع خرید تاپر و محافظ</h3>
			<?php $gi = 0; foreach ( $higer_accessories['guide'] as $g ) : $gi++; ?>
			<details class="hg-acc"<?php echo 1 === $gi ? ' open' : ''; ?>><summary><?php echo esc_html( $g['q'] ); ?></summary><div class="hg-acc-body"><?php echo esc_html( $g['a'] ); ?></div></details>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ===== چرا هیگر + سؤالات پرتکرار ===== -->
<section class="hg-sec" id="hg-faq" style="background:#faf7ef">
	<div class="hg-wrap">
		<div class="hg-why">
			<figure><?php if ( ! empty( $higer_images['factory'] ) ) : ?><img src="<?php echo esc_url( $higer_images['factory'] ); ?>" alt="تصویر تشک‌های هیگر" loading="lazy"><?php else : ?><div class="hg-midnight hg-grid-lines" style="min-height:16rem"></div><?php endif; ?></figure>
			<div>
				<span class="hg-kicker">درباره هیگر</span>
				<h2 class="hg-h2">تشک <span class="hg-gold-text">هیگر</span></h2>
				<p class="hg-lead">برای آشنایی با مدل‌ها و اطلاع از شرایط خرید، با فروشگاه تماس بگیرید.</p>
				<a class="hg-btn-dark" style="margin-top:1.5rem" href="<?php echo esc_url( $higer_store['tel'] ); ?>">تماس با فروشگاه</a>
			</div>
		</div>
		<div style="margin-top:3rem;max-width:56rem;margin-inline:auto">
			<div style="text-align:center;margin-bottom:1.25rem">
				<span class="hg-kicker">؟ سؤالات پرتکرار</span>
				<h2 class="hg-h2" style="font-size:1.6rem">سؤالات <span class="hg-gold-text">متداول</span></h2>
			</div>
			<?php $fi = 0; foreach ( $higer_faqs as $f ) : $fi++; ?>
			<details class="hg-acc"<?php echo 1 === $fi ? ' open' : ''; ?>><summary><?php echo esc_html( $f['q'] ); ?></summary><div class="hg-acc-body"><?php echo esc_html( $f['a'] ); ?></div></details>
			<?php endforeach; ?>
			<div style="text-align:center;margin-top:1.5rem"><a class="hg-btn-dark" href="<?php echo esc_url( $higer_store['tel'] ); ?>">تماس با فروشگاه: <?php echo esc_html( $higer_store['phone'] ); ?></a></div>
		</div>
	</div>
</section>

<div class="hg-float">
	<button type="button" class="hg-to-top" data-hg-top aria-label="بازگشت به بالا">↑</button>
	<a class="hg-call" href="<?php echo esc_url( $higer_store['tel'] ); ?>" aria-label="تماس با مشاور هیگر">☎</a>
</div>
<?php endif; ?>
<script type="application/json" data-higer-data>{"products":<?php echo $js_products_json; ?>,"config":<?php echo $js_config_json; ?>}</script>
</div>
<script>
(function () {
'use strict';
function higerMountFinder(root, PRODUCTS, CFG) {
  var ICONS = {
  "Baby": "<path d=\"M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5\"></path><path d=\"M15 12h.01\"></path><path d=\"M19.38 6.813A9 9 0 0 1 20.8 10.2a2 2 0 0 1 0 3.6 9 9 0 0 1-17.6 0 2 2 0 0 1 0-3.6A9 9 0 0 1 12 3c2 0 3.5 1.1 3.5 2.5s-.9 2.5-2 2.5c-.8 0-1.5-.4-1.5-1\"></path><path d=\"M9 12h.01\"></path>",
  "Zap": "<path d=\"M15.914 4a1.5 1.5 0 00-2.474-1.561l-9 9A1.5 1.5 0 005.5 14h4.002a.5.5 0 01.471.666L8.086 20a1.5 1.5 0 002.475 1.56l9-9A1.5 1.5 0 0018.5 10h-3.997a.5.5 0 01-.472-.667z\"></path>",
  "Briefcase": "<path d=\"M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16\"></path><rect width=\"20\" height=\"14\" x=\"2\" y=\"6\" rx=\"2\"></rect>",
  "Accessibility": "<circle cx=\"16\" cy=\"4\" r=\"1\"></circle><path d=\"m18 19 1-7-6 1\"></path><path d=\"m5 8 3-3 5.5 3-2.36 3.5\"></path><path d=\"M4.24 14.5a5 5 0 0 0 6.88 6\"></path><path d=\"M13.76 17.5a5 5 0 0 0-6.88-6\"></path>",
  "User": "<path d=\"M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2\"></path><circle cx=\"12\" cy=\"7\" r=\"4\"></circle>",
  "Users": "<path d=\"M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2\"></path><path d=\"M16 3.128a4 4 0 0 1 0 7.744\"></path><path d=\"M22 21v-2a4 4 0 0 0-3-3.87\"></path><circle cx=\"9\" cy=\"7\" r=\"4\"></circle>",
  "Heart": "<path d=\"M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5\"></path>",
  "Bone": "<path d=\"M17 10c.7-.7 1.69 0 2.5 0a2.5 2.5 0 1 0 0-5 .5.5 0 0 1-.5-.5 2.5 2.5 0 1 0-5 0c0 .81.7 1.8 0 2.5l-7 7c-.7.7-1.69 0-2.5 0a2.5 2.5 0 0 0 0 5c.28 0 .5.22.5.5a2.5 2.5 0 1 0 5 0c0-.81-.7-1.8 0-2.5Z\"></path>",
  "Disc3": "<circle cx=\"12\" cy=\"12\" r=\"10\"></circle><path d=\"M6 12c0-1.7.7-3.2 1.8-4.2\"></path><circle cx=\"12\" cy=\"12\" r=\"2\"></circle><path d=\"M18 12c0 1.7-.7 3.2-1.8 4.2\"></path>",
  "Smile": "<path d=\"M15 10V9\"></path><path d=\"M16.472 15a6 6 0 01-8.943 0\"></path><path d=\"M9 10V9\"></path><circle cx=\"12\" cy=\"12\" r=\"10\"></circle>",
  "Footprints": "<path d=\"M4 16v-2.38C4 11.5 2.97 10.5 3 8c.03-2.72 1.49-6 4.5-6C9.37 2 10 3.8 10 5.5c0 3.11-2 5.66-2 8.68V16a2 2 0 1 1-4 0Z\"></path><path d=\"M20 20v-2.38c0-2.12 1.03-3.12 1-5.62-.03-2.72-1.49-6-4.5-6C14.63 6 14 7.8 14 9.5c0 3.11 2 5.66 2 8.68V20a2 2 0 1 0 4 0Z\"></path><path d=\"M16 17h4\"></path><path d=\"M4 13h4\"></path>",
  "ShieldCheck": "<path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"></path><path d=\"m9 12 2 2 4-4\"></path>",
  "Snowflake": "<path d=\"m10 20-1.25-2.5L6 18\"></path><path d=\"M10 4 8.75 6.5 6 6\"></path><path d=\"m14 20 1.25-2.5L18 18\"></path><path d=\"m14 4 1.25 2.5L18 6\"></path><path d=\"m17 21-3-6h-4\"></path><path d=\"m17 3-3 6 1.5 3\"></path><path d=\"M2 12h6.5L10 9\"></path><path d=\"m20 10-1.5 2 1.5 2\"></path><path d=\"M22 12h-6.5L14 15\"></path><path d=\"m4 10 1.5 2L4 14\"></path><path d=\"m7 21 3-6-1.5-3\"></path><path d=\"m7 3 3 6h4\"></path>",
  "VolumeX": "<path d=\"M11 4.702a.7.7 0 0 0-1.203-.498L6.413 7.587A1.4 1.4 0 0 1 5.416 8H3a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2.416a1.4 1.4 0 0 1 .997.413l3.383 3.384A.7.7 0 0 0 11 19.298z\"></path><path d=\"m16.5 14.5 5-5\"></path><path d=\"m16.5 9.5 5 5\"></path>",
  "BadgeCheck": "<path d=\"M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z\"></path><path d=\"m16 9-5.5 5.5L8 12\"></path>",
  "Wallet": "<path d=\"M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1\"></path><path d=\"M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4\"></path>",
  "Cloud": "<path d=\"M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z\"></path>",
  "ChevronRight": "<path d=\"m9 18 6-6-6-6\"></path>",
  "ChevronLeft": "<path d=\"m15 18-6-6 6-6\"></path>",
  "Sparkles": "<path d=\"M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z\"></path><path d=\"M20 2v4\"></path><path d=\"M22 4h-4\"></path><circle cx=\"4\" cy=\"20\" r=\"2\"></circle>",
  "RotateCcw": "<path d=\"M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8\"></path><path d=\"M3 3v5h5\"></path>",
  "Phone": "<path d=\"M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384\"></path>",
  "ExternalLink": "<path d=\"M15 3h6v6\"></path><path d=\"M10 14 21 3\"></path><path d=\"M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6\"></path>",
  "Check": "<path d=\"M20 6 9 17l-5-5\"></path>",
  "Ruler": "<path d=\"M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z\"></path><path d=\"m14.5 12.5 2-2\"></path><path d=\"m11.5 9.5 2-2\"></path><path d=\"m8.5 6.5 2-2\"></path><path d=\"m17.5 15.5 2-2\"></path>",
  "Weight": "<circle cx=\"12\" cy=\"5\" r=\"3\"></circle><path d=\"M6.5 8a2 2 0 0 0-1.905 1.46L2.1 18.5A2 2 0 0 0 4 21h16a2 2 0 0 0 1.925-2.54L19.4 9.5A2 2 0 0 0 17.48 8Z\"></path>",
  "Stethoscope": "<path d=\"M11 2v2\"></path><path d=\"M5 2v2\"></path><path d=\"M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1\"></path><path d=\"M8 15a6 6 0 0 0 12 0v-3\"></path><circle cx=\"20\" cy=\"10\" r=\"2\"></circle>",
  "Scale": "<path d=\"M12 3v18\"></path><path d=\"m19 8 3 8a5 5 0 0 1-6 0zV7\"></path><path d=\"M3 7h1a17 17 0 0 0 8-2 17 17 0 0 0 8 2h1\"></path><path d=\"m5 8 3 8a5 5 0 0 1-6 0zV7\"></path><path d=\"M7 21h10\"></path>",
  "Star": "<path d=\"M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z\"></path>",
  "BedDouble": "<path d=\"M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8\"></path><path d=\"M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4\"></path><path d=\"M12 4v6\"></path><path d=\"M2 18h20\"></path>",
  "Table2": "<path d=\"M3 9h18\"></path><path d=\"M9 3v18\"></path><rect x=\"3\" y=\"3\" width=\"18\" height=\"18\" rx=\"2\"></rect>"
};

  var mount = root.querySelector('[data-hg-finder]');
  if (!mount) return;
  var uid = root.id || ('higer-' + Math.random().toString(36).slice(2, 9));
  var shop = CFG.shop || 'https://higermattress.ir';
  var phone = CFG.phone || '';
  var tel = CFG.tel || '';
  var coreNames = { bonnell: 'فنر متصل', pocket: 'فنر منفصل', rebond: 'ریباند (بدون فنر)', foam: 'فوم سنگین' };
  var coreHues = { bonnell: '#d9a13b', pocket: '#3a6189', rebond: '#8a6d3b', foam: '#5b7a4e' };
  (CFG.cores || []).forEach(function (c) { coreNames[c.key] = c.fa; });
  var FA = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
  function toFa(n) { return String(n).replace(/[0-9]/g, function (d) { return FA[+d]; }); }
  function esc(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
      return { '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#39;' }[c];
    });
  }
  function icon(name, size, weight) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="' + (size || 16) + '" height="' + (size || 16) +
      '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' + (weight || 2) +
      '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' + (ICONS[name] || '') + '</svg>';
  }
  function shopUrl(q) { return shop.replace(/\/$/, '') + '/?s=' + encodeURIComponent(q) + '&post_type=product'; }
  function productUrl(p) {
    var slug = String(p.id || '').toLowerCase();
    return /^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(slug) ? shop.replace(/\/$/, '') + '/product/' + slug + '/' : shopUrl(p.fa);
  }
  function defaults() {
    return { age:null, weight:78, height:172, position:null, pain:null, sleepers:null, firmness:3, budget:null, priority:null };
  }
  var answers = defaults();
  var step = 1;
  var results = null;
  var showCompare = false;
  var titles = ['سن شما','قد و وزن','وضعیت خواب','مشکل یا درد جسمی','همراه تخت','سفتی دلخواه','بودجه شما','اولویت اصلی'];
  var options = {
    age: [
      { key:'teen', label:'زیر ۱۸ سال', sub:'نوجوان', icon:'Baby' },
      { key:'young', label:'۱۸ تا ۳۵ سال', sub:'جوان', icon:'Zap' },
      { key:'adult', label:'۳۶ تا ۵۵ سال', sub:'بزرگسال', icon:'Briefcase' },
      { key:'senior', label:'بالای ۵۵ سال', sub:'بزرگسال', icon:'Accessibility' }
    ],
    position: [
      { key:'back', label:'خواب پشت', sub:'بیشتر به پشت می‌خوابم' },
      { key:'side', label:'خواب پهلو', sub:'بیشتر به پهلو می‌خوابم' },
      { key:'stomach', label:'روی شکم', sub:'بیشتر روی شکم می‌خوابم' },
      { key:'combo', label:'ترکیبی', sub:'وضعیت خوابم را تغییر می‌دهم' }
    ],
    pain: [
      { key:'none', label:'بدون مشکل خاص', icon:'Smile' },
      { key:'back', label:'کمردرد', icon:'Bone' },
      { key:'disc', label:'دیسک و مهره', icon:'Disc3' },
      { key:'neck', label:'گردن و شانه', icon:'Accessibility' },
      { key:'joint', label:'مفصل و زانو', icon:'Footprints' }
    ],
    sleepers: [
      { key:'single', label:'تک‌نفره', sub:'فقط خودم می‌خوابم', icon:'User' },
      { key:'coupleCalm', label:'دونفره آرام', sub:'حرکت کم، خواب آرام', icon:'Heart' },
      { key:'coupleMoving', label:'دونفره پرتحرک', sub:'یکی زیاد غلت می‌زند', icon:'Users' }
    ],
    budget: [
      { key:1, label:'تا ۳۰ میلیون', sub:'تومان' },
      { key:2, label:'۳۰ تا ۶۰ میلیون', sub:'تومان' },
      { key:3, label:'۶۰ تا ۱۵۰ میلیون', sub:'تومان' },
      { key:4, label:'بالای ۱۵۰ میلیون', sub:'تومان' }
    ],
    priority: [
      { key:'ortho', label:'حمایت بیشتر', icon:'Bone' },
      { key:'cool', label:'خنکی و تهویه', icon:'Snowflake' },
      { key:'quiet', label:'انتقال حرکت کمتر', icon:'VolumeX' },
      { key:'warranty', label:'مدت گارانتی', icon:'BadgeCheck' },
      { key:'price', label:'قیمت مناسب', icon:'Wallet' },
      { key:'soft', label:'سطح نرم‌تر', icon:'Cloud' }
    ]
  };
  var firmLabels = ['', 'خیلی نرم', 'نرم', 'متوسط', 'سفت', 'خیلی سفت'];
  /* Same scoring and tie-breaking as src/recommend.ts in the repository. */
  function clamp(v, min, max) {
    return Math.min(max == null ? 5 : max, Math.max(min == null ? 1 : min, v));
  }
  function bmi() { return answers.weight / Math.pow(answers.height / 100, 2); }
  function bmiInfo() {
    if (answers.age === 'teen') return { label:'تفسیر متناسب با سن', tone:'low' };
    var n = bmi();
    return n < 18.5 ? { label:'کمبود وزن', tone:'low' } : n < 25 ? { label:'وزن نرمال', tone:'ok' } :
      n < 30 ? { label:'اضافه‌وزن', tone:'warn' } : { label:'چاقی', tone:'high' };
  }
  function bmiPercent() { return clamp(((bmi() - 14) / 24) * 100, 0, 100); }
  function band(n) { return n <= 30000000 ? 1 : n <= 60000000 ? 2 : n <= 150000000 ? 3 : 4; }
  function desiredFirmness(a) {
    var d = a.firmness;
    if (a.weight > 100) d += 0.7; else if (a.weight < 55) d -= 0.7;
    if (a.position === 'stomach') d += 0.6;
    else if (a.position === 'side') d -= 0.6;
    else if (a.position === 'back') d += 0.2;
    if (a.pain && a.pain !== 'none') d += a.pain === 'joint' ? 0.1 : 0.5;
    if (a.age === 'teen') d += 0.3; else if (a.age === 'senior') d -= 0.2;
    return clamp(d);
  }
  function scoreOne(p, a) {
    var firmScore = clamp(1 - Math.abs(p.firm - desiredFirmness(a)) / 2.3, 0, 1);
    var need = clamp(3 + (a.weight > 95 ? 1 : a.weight < 55 ? -1 : 0) +
      (a.pain && a.pain !== 'none' ? 1 : 0) + (a.age === 'teen' ? 0.5 : 0));
    var supportScore = clamp(1 - Math.abs(p.support - need) / 2.6, 0, 1);
    var motionScore = a.sleepers === 'coupleMoving' ? p.motion / 5 :
      a.sleepers === 'coupleCalm' ? 0.65 + 0.35 * p.motion / 5 : 0.8 + 0.2 * p.motion / 5;
    var orthoScore = 1;
    if (a.pain && a.pain !== 'none') {
      orthoScore = p.ortho / 5;
      if ((a.pain === 'disc' || a.pain === 'back') && p.core === 'rebond') orthoScore = clamp(orthoScore + 0.12);
      if (a.pain === 'disc' && p.core === 'bonnell') orthoScore -= 0.15;
    }
    var budget = a.budget == null ? 2 : a.budget;
    var diff = band(p.startPrice) - budget;
    var budgetScore = diff === 0 ? 1 : diff < 0 ? 0.92 + diff * 0.05 : diff === 1 ? 0.32 : 0.06;
    var weightBonus = a.weight >= p.idealMin && a.weight <= p.idealMax ? 0.05 : -0.09;
    var s = firmScore * 0.30 + supportScore * 0.22 + motionScore * 0.16 + orthoScore * 0.16 +
      clamp(budgetScore, 0, 1) * 0.12 + weightBonus;
    if (a.priority === 'ortho') s += p.ortho / 5 * 0.08;
    else if (a.priority === 'cool') s += p.cooling / 5 * 0.08;
    else if (a.priority === 'quiet') s += p.motion / 5 * 0.08;
    else if (a.priority === 'warranty') s += p.warranty / 10 * 0.08;
    else if (a.priority === 'price') s += band(p.startPrice) <= budget ? 0.08 : 0.02;
    else if (a.priority === 'soft') s += (6 - p.firm) / 5 * 0.08;
    if (a.position && (p.positions || []).indexOf(a.position) !== -1) s += 0.03;
    return Math.round(62 + clamp(s / 1.08, 0, 1) * 37);
  }
  function analyze(a) {
    var scored = PRODUCTS.map(function (p) {
      return { product:p, pct:scoreOne(p, a) };
    }).sort(function (x, y) { return y.pct - x.pct; });
    var top = scored.slice(0, 3);
    if (top.length < 3) return top;
    var cores = {};
    top.forEach(function (r) { cores[r.product.core] = true; });
    if (Object.keys(cores).length < 2) {
      var alt = scored.find(function (r) {
        return !top.slice(0, 2).some(function (t) { return t.product.id === r.product.id; }) && r.product.core !== top[0].product.core;
      });
      if (alt && top[2].pct - alt.pct <= 8) top[2] = alt;
    }
    return top;
  }

  function valid() {
    var key = [null,'age',null,'position','pain','sleepers',null,'budget','priority'][step];
    return !key || answers[key] !== null;
  }
  function positionGlyph(kind) {
    var shapes = {
      back:'<circle cx="14" cy="28" r="4.5"/><path d="M20 29h26c6 0 10 3 12 7"/><path d="M34 29v-6" opacity="0.7"/>',
      side:'<circle cx="13" cy="27" r="4.5"/><path d="M19 28c8 0 9-5 16-5s10 5 10 5l10 3"/><path d="M22 33c6 2 12 2 18 0" opacity="0.7"/>',
      stomach:'<circle cx="13" cy="29" r="4.5"/><path d="M19 30h30c6 0 9-3 10-8"/><path d="M30 30v-4" opacity="0.7"/>',
      combo:'<circle cx="13" cy="28" r="4.5"/><path d="M19 29h18"/><path d="M44 17a7 7 0 1 1-2 5"/><path d="M44 12v6h-6"/>'
    };
    return '<svg class="hf-position-glyph" viewBox="0 0 72 44" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true">' +
      '<line x1="4" y1="36" x2="68" y2="36" opacity="0.55"/>' + shapes[kind] + '</svg>';
  }
  function choiceGrid(key, layout, mode) {
    return '<div class="hf-options ' + layout + '">' + options[key].map(function (o) {
      var selected = answers[key] === o.key;
      var lead = mode === 'position' ? positionGlyph(o.key) : mode === 'budget' ?
        '<span class="hf-budget-number">' + toFa(o.key) + '</span>' : mode === 'compact' || mode === 'sleeper' ?
        icon(o.icon, mode === 'sleeper' ? 30 : 26, mode === 'sleeper' ? 1.7 : 1.8) :
        '<span class="hf-choice-icon">' + icon(o.icon, 26, 1.8) + '</span>';
      var copy = '<span class="hf-choice-title">' + esc(o.label) + '</span>' +
        (o.sub ? '<span class="hf-choice-sub">' + esc(o.sub) + '</span>' : '');
      if (mode === 'age' || mode === 'budget') copy = '<span class="hf-choice-copy">' + copy + '</span>';
      return '<button type="button" class="hf-choice ' + (mode || '') + '" data-hf-answer="' + key + '" data-value="' + esc(o.key) +
        '" data-active="' + selected + '" aria-pressed="' + selected + '">' + lead + copy + '</button>';
    }).join('') + '</div>';
  }
  function rangeBox(key, label, min, max, unit, ticks, glyph) {
    return '<div class="hf-range-box"><div class="hf-range-head"><label for="' + uid + '-' + key + '">' + icon(glyph, 14) + label + '</label>' +
      '<output for="' + uid + '-' + key + '"><span data-hf-output="' + key + '">' + toFa(answers[key]) + '</span> <small>' + unit + '</small></output></div>' +
      '<input id="' + uid + '-' + key + '" type="range" class="hf-range" data-hf-range="' + key + '" min="' + min + '" max="' + max +
      '" step="1" value="' + answers[key] + '" aria-valuetext="' + answers[key] + ' ' + unit + '" style="--fill:' +
      ((answers[key] - min) / (max - min) * 100) + '%"><div class="hf-range-ticks">' +
      ticks.map(function (n) { return '<span>' + n + '</span>'; }).join('') + '</div></div>';
  }
  function renderInlineBmi() {
    var info = bmiInfo();
    return '<div class="hf-inline-bmi-main"><span class="hf-scale-icon">' + icon('Scale', 22, 2.2) +
      '</span><span><small>شاخص توده بدنی (BMI)</small><b dir="ltr">' + bmi().toFixed(1) + '</b></span></div>' +
      '<div class="hf-bmi-detail"><span class="hf-bmi-badge ' + info.tone + '">' + info.label + '</span>' +
      '<div class="hf-bmi-track" aria-hidden="true"><div class="hf-bmi-fill" style="width:' + bmiPercent() + '%"></div></div>' +
      (answers.age === 'teen' ? '<p>تفسیر BMI برای افراد زیر ۱۸ سال باید متناسب با سن انجام شود.</p>' : '') + '</div>';
  }
  function question() {
    var title = '', sub = '', content = '';
    if (step === 1) {
      title = 'سن شما چقدر است؟'; sub = 'بازه سنی خود را انتخاب کنید.';
      content = choiceGrid('age', 'two', 'age');
    } else if (step === 2) {
      title = 'قد و وزن شما؟'; sub = 'قد و وزن خود را با اسلایدرها تنظیم کنید.';
      content = '<div class="hf-range-stack">' +
        rangeBox('weight', 'وزن بدن', 35, 180, 'کیلوگرم', ['۳۵','۱۱۰','۱۸۰+'], 'Weight') +
        rangeBox('height', 'قد', 130, 220, 'سانتی‌متر', ['۱۳۰','۱۷۵','۲۲۰'], 'Ruler') +
        '<div class="hf-inline-bmi" data-hf-inline-bmi aria-live="polite">' + renderInlineBmi() + '</div></div>';
    } else if (step === 3) {
      title = 'معمولاً در چه وضعیتی می‌خوابید؟'; sub = 'حالتی را انتخاب کنید که بیشتر در آن می‌خوابید.';
      content = choiceGrid('position', 'two', 'position');
    } else if (step === 4) {
      title = 'مشکل جسمی یا درد مزمن دارید؟'; sub = 'در صورت وجود درد، گزینه مرتبط را انتخاب کنید.';
      content = choiceGrid('pain', 'compact', 'compact') + '<p class="hf-note hf-enter" data-hf-pain-note' +
        (answers.pain && answers.pain !== 'none' ? '' : ' hidden') + '>' + icon('Stethoscope', 14) +
        '<span>تشک‌سنج ابزار تشخیص یا درمان نیست. اگر درد یا بیماری دارید، درباره انتخاب تشک با پزشک مشورت کنید.</span></p>';
    } else if (step === 5) {
      title = 'تخت را با چه کسی شریک هستید؟'; sub = 'تعداد افراد و میزان تحرک آن‌ها را انتخاب کنید.';
      content = choiceGrid('sleepers', 'three', 'sleeper');
    } else if (step === 6) {
      title = 'چه میزان سفتی را ترجیح می‌دهید؟'; sub = 'میزان نرمی یا سفتی دلخواه خود را انتخاب کنید.';
      content = '<div class="hf-firmness" role="radiogroup" aria-label="میزان سفتی">' + [5,4,3,2,1].map(function (v) {
        return '<button type="button" class="hf-firm-choice" role="radio" aria-checked="' + (answers.firmness === v) +
          '" tabindex="' + (answers.firmness === v ? '0' : '-1') + '" data-hf-answer="firmness" data-value="' + v + '"><b>' + toFa(v) +
          '</b><span>' + firmLabels[v] + '</span></button>';
      }).join('') + '</div><p class="hf-firm-hint">از خیلی نرم تا خیلی سفت</p>';
    } else if (step === 7) {
      title = 'بازه بودجه شما؟'; sub = 'بودجه دلخواه خود را انتخاب کنید. قیمت روز را در فروشگاه بررسی کنید.';
      content = choiceGrid('budget', 'two', 'budget');
    } else {
      title = 'مهم‌ترین اولویت شما چیست؟'; sub = 'گزینه‌ای را انتخاب کنید که برایتان مهم‌تر است.';
      content = choiceGrid('priority', 'compact', 'compact');
    }
    return '<fieldset class="hf-question"><legend>' + title + '</legend><p class="hf-question-sub">' + sub + '</p>' + content + '</fieldset>';
  }
  function renderProgress() {
    var progress = results ? 100 : Math.round((step - 1) / 8 * 100 + 100 / 8 / 2);
    progressEl.innerHTML = '<div class="hf-progress-meta"><span>' + (results ? 'نتایج آماده است' :
      'مرحله ' + toFa(step) + ' از ۸ \u2014 ' + titles[step - 1]) + '</span><span dir="ltr">' + toFa(progress) + '٪</span></div>' +
      '<div class="hf-progress-track" role="progressbar" aria-label="پیشرفت تشک‌سنج" aria-valuemin="0" aria-valuemax="100" aria-valuenow="' + progress +
      '"><div class="hf-progress-fill" style="width:' + progress + '%"></div></div>' +
      '<ol class="hf-steps" aria-label="مراحل تشک‌سنج">' + titles.map(function (t, i) {
        var done = results || i + 1 < step, current = !results && i + 1 === step;
        return '<li class="hf-step' + (done ? ' done' : current ? ' current' : '') + '"' + (current ? ' aria-current="step"' : '') +
          '><span class="hf-step-circle">' + (done ? icon('Check', 11, 3.5) : toFa(i + 1)) + '</span><span class="hf-step-label">' + t + '</span></li>';
      }).join('') + '</ol>';
  }
  function nav() {
    return '<div class="hf-nav"><button type="button" class="hf-prev" data-hf-nav="prev"' + (step === 1 ? ' disabled tabindex="-1"' : '') + '>' +
      icon('ChevronRight', 16) + 'مرحله قبل</button><span class="hf-nav-hint" data-hf-hint' + (valid() ? ' hidden' : '') +
      '>برای ادامه یکی از گزینه‌ها را انتخاب کنید</span><button type="button" class="hf-next' + (step === 8 ? ' final' : '') +
      '" data-hf-nav="next"' + (valid() ? '' : ' disabled') + '>' + (step === 8 ? 'نمایش تشک‌های مناسب من' + icon('Sparkles', 16) :
      'مرحله بعد' + icon('ChevronLeft', 16)) + '</button></div>';
  }
  function renderAside() {
    var rows = [['age','سن'],['position','وضعیت خواب'],['pain','وضعیت جسم'],['sleepers','همراه تخت'],['budget','بودجه'],['priority','اولویت']];
    asideEl.innerHTML = '<div class="hf-body-card-header"><p>' + icon('BedDouble', 15) +
      'بدن‌سنج زنده شما</p><span>بدون ثبت‌نام</span></div><div class="hf-body-metrics">' +
      '<div><small>قد</small><b data-hf-live-height>' + toFa(answers.height) + '</b><span>سانتی‌متر</span></div>' +
      '<div><small>وزن</small><b data-hf-live-weight>' + toFa(answers.weight) + '</b><span>کیلوگرم</span></div></div>' +
      '<div class="hf-body-summary"><div class="hf-summary-bmi"><span>BMI: <b dir="ltr" data-hf-live-bmi>' + bmi().toFixed(1) +
      '</b></span><span>' + bmiInfo().label + '</span></div><div class="hf-bmi-track"><div class="hf-bmi-fill" style="width:' +
      bmiPercent() + '%"></div></div><ul class="hf-summary-answers">' + rows.filter(function (r) { return answers[r[0]] !== null; }).map(function (r) {
        var item = options[r[0]].find(function (o) { return o.key === answers[r[0]]; });
        return '<li><span>' + r[1] + '</span><b>' + esc(item ? item.label : '') + '</b></li>';
      }).join('') + '</ul></div>';
  }
  function matchRing(idx) {
    var c = 2 * Math.PI * 40;
    var gradientId = uid + '-gold-' + idx;
    return '<div class="hf-ring" aria-label="پیشنهاد ' + (idx + 1) + '"><svg viewBox="0 0 100 100" aria-hidden="true">' +
      '<circle cx="50" cy="50" r="40" fill="none" stroke="#ece7d8" stroke-width="10"/>' +
      '<circle cx="50" cy="50" r="40" fill="none" stroke="url(#' + gradientId + ')" stroke-width="10" stroke-linecap="round"' +
      ' stroke-dasharray="' + c + ' ' + c + '" class="hf-ring-anim" style="--ring-c:' + c + '"/>' +
      '<defs><linearGradient id="' + gradientId + '" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#e7b95c"/>' +
      '<stop offset="55%" stop-color="#d9a13b"/><stop offset="100%" stop-color="#a86f1c"/></linearGradient></defs></svg>' +
      '<div class="hf-ring-label"><b>' + toFa(idx + 1) + '</b><span>پیشنهاد</span></div></div>';
  }
  function resultCard(row, idx) {
    var p = row.product;
    return '<article class="hf-result' + (idx === 0 ? ' best' : '') + '" data-hf-product="' + esc(p.id) + '">' +
      (idx === 0 ? '<span class="hf-result-best">' + icon('Star', 10) + 'پیشنهاد اول</span>' : '') + '<div class="hf-result-row">' +
      matchRing(idx) + '<div class="hf-result-content"><div class="hf-result-title"><h4>' + esc(p.fa) +
      '</h4><span class="hf-result-en" dir="ltr">' + esc(p.en.toUpperCase()) + '</span><span class="hf-core-tag"><i style="background:' +
      (coreHues[p.core] || '#d9a13b') + '"></i>هسته ' + esc(coreNames[p.core]) + '</span>' +
      (p.badge ? '<span class="hf-product-badge">' + esc(p.badge) + '</span>' : '') + '</div>' +
      (p.blurb ? '<p class="hf-blurb">' + esc(p.blurb) + '</p>' : '') +
      '</div><div class="hf-price-cta"><a class="hf-order" href="' + esc(productUrl(p)) +
      '" target="_blank" rel="noopener noreferrer">مشاهده در فروشگاه' + icon('ExternalLink', 11) + '</a></div></div></article>';
  }
  function comparison() {
    return '<div class="hf-table-wrap hf-enter" id="' + uid + '-compare"' + (showCompare ? '' : ' hidden') +
      '><table class="hf-table"><thead><tr><th scope="col">مشخصه</th>' + results.map(function (r) {
        return '<th scope="col">' + esc(r.product.fa) + '</th>';
      }).join('') + '</tr></thead><tbody><tr><td>نوع هسته ثبت‌شده</td>' + results.map(function (r) {
        return '<td>' + esc(coreNames[r.product.core]) + '</td>';
      }).join('') + '</tr><tr><td>قیمت و جزئیات</td>' + results.map(function (r) {
        return '<td><a href="' + esc(productUrl(r.product)) + '" target="_blank" rel="noopener noreferrer">مشاهده در فروشگاه</a></td>';
      }).join('') + '</tr></tbody></table></div>';
  }
  function renderResults() {
    var extrasHref = root.querySelector('#hg-accessories') ? '#hg-accessories' : shopUrl('تاپر');
    var protectorHref = root.querySelector('#hg-accessories') ? '#hg-accessories' : shopUrl('محافظ تشک');
    return '<div class="hf-results-head"><div><h3>تشک‌های پیشنهادی شما</h3><p>این گزینه‌ها با توجه به پاسخ‌های شما و اطلاعات ثبت‌شده مرتب شده‌اند.</p></div>' +
      '<button type="button" class="hf-restart" data-hf-nav="restart">' +
      icon('RotateCcw', 13) + 'شروع مجدد</button></div><div class="hf-results-list">' + results.map(resultCard).join('') +
      '</div><div class="hf-comparison"><button type="button" class="hf-compare-toggle" data-hf-compare aria-expanded="' + showCompare +
      '" aria-controls="' + uid + '-compare">' + icon('Table2', 13) + '<span>مقایسه مدل‌ها</span></button>' + comparison() + '</div>' +
      '<div class="hf-extras"><a class="hf-extra" href="' + esc(extrasHref) + '"><span class="hf-extra-icon">' + icon('BedDouble', 20, 1.9) +
      '</span><span><b>تاپر تشک هیگر</b><small><u>مشاهده محصولات و جزئیات</u></small></span></a>' +
      '<a class="hf-extra" href="' + esc(protectorHref) + '"><span class="hf-extra-icon">' + icon('ShieldCheck', 20, 1.9) +
      '</span><span><b>محافظ تشک هیگر</b><small><u>مشاهده محصولات و جزئیات</u></small></span></a></div>' +
      '<p class="hf-contact-note">تشک‌سنج یک راهنمای اولیه است؛ بخشی از امتیازهای آن برآوردی است و به داده زنده فروشگاه متصل نیست. این پیشنهادها جایگزین توصیه پزشکی نیستند. قیمت، مشخصات و موجودی را در فروشگاه بررسی کنید.' +
      '<a href="' + esc(tel) + '" dir="ltr">' + icon('Phone', 11) + esc(phone) + '</a></p>';
  }
  function render(focus) {
    renderProgress();
    bodyEl.innerHTML = '<div class="hf-enter">' + (results ? renderResults() : question() + nav()) + '</div>';
    renderAside();
    if (focus) {
      var heading = bodyEl.querySelector('legend, h3');
      if (heading) { heading.tabIndex = -1; heading.focus({ preventScroll:true }); }
    }
  }
  function choose(button) {
    var key = button.getAttribute('data-hf-answer');
    var value = button.getAttribute('data-value');
    answers[key] = key === 'budget' || key === 'firmness' ? Number(value) : value;
    bodyEl.querySelectorAll('[data-hf-answer="' + key + '"]').forEach(function (b) {
      var active = String(answers[key]) === b.getAttribute('data-value');
      b.setAttribute('data-active', String(active));
      b.setAttribute(key === 'firmness' ? 'aria-checked' : 'aria-pressed', String(active));
      if (key === 'firmness') b.tabIndex = active ? 0 : -1;
    });
    var hint = bodyEl.querySelector('[data-hf-hint]');
    if (hint) hint.hidden = valid();
    var next = bodyEl.querySelector('[data-hf-nav="next"]');
    if (next) next.disabled = !valid();
    var note = bodyEl.querySelector('[data-hf-pain-note]');
    if (note) note.hidden = !answers.pain || answers.pain === 'none';
    renderAside();
  }

  mount.innerHTML = '<div class="hf-main"><div class="hf-progress" data-hf-progress></div><div class="hf-form-body" data-hf-body></div></div>' +
    '<aside class="hf-aside" aria-label="خلاصه زنده انتخاب‌ها"><div class="hf-aside-sticky"><div class="hf-body-card" data-hf-live></div>' +
    '<div class="hf-trust"><p class="hf-trust-title">برای انتخاب تشک نیاز به راهنمایی دارید؟</p>' +
    '<p class="hf-trust-desc">برای بررسی مدل‌ها و شرایط خرید با فروشگاه تماس بگیرید.</p>' +
    '<a class="hf-human" href="' + esc(tel) + '">' + icon('Phone', 13) + 'تماس با فروشگاه: ' + esc(phone) + '</a></div></div></aside>';
  var progressEl = mount.querySelector('[data-hf-progress]');
  var bodyEl = mount.querySelector('[data-hf-body]');
  var asideEl = mount.querySelector('[data-hf-live]');

  mount.addEventListener('click', function (event) {
    var button = event.target.closest('button');
    if (!button || !mount.contains(button) || button.disabled) return;
    if (button.hasAttribute('data-hf-answer')) { choose(button); return; }
    if (button.hasAttribute('data-hf-compare')) {
      showCompare = !showCompare;
      button.setAttribute('aria-expanded', String(showCompare));
      button.querySelector('span').textContent = showCompare ? 'بستن مقایسه' : 'مقایسه مدل‌ها';
      mount.querySelector('.hf-table-wrap').hidden = !showCompare;
      return;
    }
    var action = button.getAttribute('data-hf-nav');
    if (action === 'next' && valid()) {
      if (step < 8) step++; else results = analyze(answers);
    } else if (action === 'prev') {
      if (results) results = null; else step = Math.max(1, step - 1);
    } else if (action === 'restart') {
      answers = defaults(); step = 1; results = null; showCompare = false;
    } else return;
    render(true);
  });
  mount.addEventListener('input', function (event) {
    var input = event.target;
    var key = input.getAttribute('data-hf-range');
    if (!key) return;
    answers[key] = clamp(Number(input.value), Number(input.min), Number(input.max));
    input.style.setProperty('--fill', (answers[key] - Number(input.min)) / (Number(input.max) - Number(input.min)) * 100 + '%');
    input.setAttribute('aria-valuetext', answers[key] + (key === 'weight' ? ' کیلوگرم' : ' سانتی‌متر'));
    bodyEl.querySelector('[data-hf-output="' + key + '"]').textContent = toFa(answers[key]);
    bodyEl.querySelector('[data-hf-inline-bmi]').innerHTML = renderInlineBmi();
    renderAside();
  });
  mount.addEventListener('keydown', function (event) {
    var radio = event.target.closest('[role="radio"]');
    if (!radio || ['ArrowLeft','ArrowRight','ArrowUp','ArrowDown','Home','End'].indexOf(event.key) === -1) return;
    event.preventDefault();
    var radios = Array.from(bodyEl.querySelectorAll('[role="radio"]'));
    var i = radios.indexOf(radio);
    var next = event.key === 'Home' ? 0 : event.key === 'End' ? radios.length - 1 :
      (i + (event.key === 'ArrowLeft' || event.key === 'ArrowDown' ? 1 : -1) + radios.length) % radios.length;
    choose(radios[next]); radios[next].focus();
  });
  render(false);
}


function mountHigerHome(root) {
  if (root.getAttribute('data-hg-mounted')) return;
  var payload = root.querySelector('[data-higer-data]');
  var data;
  try { data = payload ? JSON.parse(payload.textContent) : {}; }
  catch (error) { console.error('Higer: invalid snippet configuration', error); return; }
  root.setAttribute('data-hg-mounted', '1');
  var products = data.products || window.HIGER_PRODUCTS || [];
  var config = data.config || window.HIGER_CFG || {};

  [
    'https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css',
    'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css'
  ].forEach(function (href) {
    if (document.querySelector('link[href="' + href + '"]')) return;
    var link = document.createElement('link');
    link.rel = 'stylesheet'; link.href = href; document.head.appendChild(link);
  });

  higerMountFinder(root, products, config);

  root.addEventListener('click', function (event) {
    var anchor = event.target.closest('a[href^="#"]');
    if (!anchor) return;
    var id = anchor.getAttribute('href').slice(1);
    var target = Array.from(root.querySelectorAll('[id]')).find(function (el) { return el.id === id; });
    if (target) { event.preventDefault(); target.scrollIntoView({ behavior:'smooth', block:'start' }); }
  });
  var toTop = root.querySelector('[data-hg-top]');
  if (toTop) {
    var onScroll = function () { toTop.classList.toggle('show', window.scrollY > 480); };
    window.addEventListener('scroll', onScroll, { passive:true });
    onScroll();
    toTop.addEventListener('click', function () { window.scrollTo({ top:0, behavior:'smooth' }); });
  }

}
document.querySelectorAll('.higer-home:not([data-hg-mounted])').forEach(mountHigerHome);
})();
</script>
<?php if ( $fullwidth && ! $only_finder ) : ?>
<script>
/* تمام‌عرض کردن اسنیپت حتی داخل ستون محدود المنتور */
(function(){var el=document.getElementById('<?php echo esc_js( $uid ); ?>');if(!el)return;
function fit(){el.style.position='relative';el.style.maxWidth='none';el.style.left='0px';
var w=document.documentElement.clientWidth;el.style.width=w+'px';
var r=el.getBoundingClientRect();el.style.left=(-r.left)+'px';}
fit();window.addEventListener('resize',fit);window.addEventListener('load',fit);setTimeout(fit,600);})();
</script>
<?php endif; ?>
<?php
		return (string) ob_get_clean();
	}
}

if ( ! shortcode_exists( 'higer_home' ) ) {
	add_shortcode( 'higer_home', 'higer_home_render' );
}

/* اگر WPCode این اسنیپت را به‌صورت شورت‌کد خودش اجرا کرد، همان‌جا چاپ کن.
   در بقیه حالت‌ها (auto-insert) چیزی چاپ نشود تا بقیه سایت تمیز بماند. */
$higer_in_shortcode = false;
foreach ( debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 30 ) as $higer_frame ) {
	if ( ! empty( $higer_frame['function'] ) && 0 === strpos( $higer_frame['function'], 'do_shortcode' ) ) {
		$higer_in_shortcode = true;
		break;
	}
}
if ( $higer_in_shortcode ) {
	echo higer_home_render();
}
