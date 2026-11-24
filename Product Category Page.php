<?php
/**
 * Higer Category — اسنیپت صفحه دسته‌بندی محصولات ووکامرس (product_cat) | نسخه v1.0
 * =====================================================================
 * کپی دقیق و مستقل از اسنیپت فروشگاه (Shop Page.php / [higer_shop])، فقط برای
 * صفحات دسته‌بندی (/product-category/...) — با همان عملکرد و ظاهر ۱۰۰٪ یکسان:
 * همان CSS، همان JS، همان HTML، همان فیلترها، همان کارت محصول، همان مقایسه
 * و همان قیمت دقیق هر سایز. تنها تفاوت: هیرو (سربرگ) مختص هر دسته‌بندی است
 * و این اسنیپت فقط روی product_cat اجرا می‌شود (صفحه /shop/ دست نمی‌خورد).
 *
 * هیرو هر دسته از بخش 'category_heroes' در تنظیمات خوانده می‌شود:
 * theme (تم رنگی)، kicker، title + accent (طلایی) + title_after، subtitle،
 * highlights (ویژگی‌های کلیدی)، art_label، finder_text و show_finder.
 * اگر دسته‌ای در category_heroes نباشد، خودکار از نام دسته، توضیح ووکامرس،
 * cores و تم والد ارث‌بری می‌کند. تصویر شاخص دسته (thumbnail_id) هم اگر
 * در ووکامرس ثبت شده باشد در هیرو نمایش داده می‌شود.
 *
 * تفاوت‌های فنی با اسنیپت فروشگاه (فقط برای جلوگیری از تداخل):
 *  - پیشوند توابع: higer_cat_ (به‌جای higer_shop_)
 *  - کلاس‌های CSS/HTML: higer-cat / hc- (به‌جای higer-shop / hs-)
 *  - شورت‌کد: [higer_category] (به‌جای [higer_shop])
 *  - کش: higer_cat_ (جدا از کش فروشگاه)
 *  - auto_replace فقط روی is_product_category() کار می‌کند.
 * هر دو اسنیپت می‌توانند هم‌زمان فعال باشند.
 *
 * ─── نصب در WPCode ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل این فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert — Location: Run Everywhere
 *  ۴. Save و Activate
 *
 * ─── نمایش در صفحه دسته‌بندی ───
 *  با المنتور پرو:
 *    Templates > Theme Builder > Product Archive (مخصوص Category)
 *    قالب را باز کنید و یک ویجت Shortcode تمام‌عرض بگذارید: [higer_category]
 *  بدون المنتور: 'auto_replace_categories' => true (پیش‌فرض) کافی است؛
 *    این اسنیپت خودش با هدر و فوتر فعلی سایت صفحه دسته را رندر می‌کند.
 *
 * ─── شورت‌کدها ───
 *  [higer_category]                              دسته فعلی صفحه (خودکار)
 *  [higer_category category="high-density-foam"] نمایش پیش‌فرض یک دسته مشخص
 *  [higer_category fullwidth="no"]               بدون حالت تمام‌عرض
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_cat_config' ) ) :
function higer_cat_config() {
	return array(

		/* --- فروشگاه و تماس --- */
		'store' => array(
			'phone'   => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'     => 'tel:+989111186485',
			'address' => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی 27، فروشگاه و دفتر مرکزی هیگر',
			'hours'   => 'همه روزه بجز روزهای تعطیل،ساعت ۹ تا ۲۱',
		),

		/* --- رفتار اسنیپت --- */
		'auto_replace'            => false, // این اسنیپت فقط برای دسته‌بندی است؛ صفحه /shop/ را دست نمی‌زند (همیشه false بماند)
		'auto_replace_categories' => true,  // true = نمایش خودکار این طرح در همه صفحات دسته‌بندی (/product-category/...) با هدر و فوتر فعلی سایت
		'shop_cache'       => 6,     // نگهداری کش کاتالوگ (ساعت)؛ با ویرایش هر محصول خودکار تازه می‌شود. ۰ = بدون کش
		'sticky_offset'    => 0,     // فاصله از بالا برای هدر چسبنده سایت (پیکسل)؛ ۰ = تشخیص خودکار ارتفاع هدر
		'hide_out_of_stock' => true,  // true = محصولات ناموجود به‌صورت پیش‌فرض از لیست پنهان می‌شوند
		'show_out_of_stock' => true,  // true = دکمه «نمایش کالاهای ناموجود» در فیلترها نمایش داده شود
		'finder_path'      => '/#hg-finder', // لینک تشک‌سنج هوشمند (خالی = پنهان)

		/* --- متن‌های سربرگ صفحه فروشگاه --- */
		'hero' => array(
			'kicker'   => 'فروشگاه محصولات هیگر',
			'title'    => 'همه محصولات و تشک‌های هیگر',
			'subtitle' => 'سایز تخت، درجه سفتی، ساختار هسته یا محدوده بودجه را انتخاب کنید تا قیمت دقیق همان سایز و مدل‌های متناسب نمایش داده شوند.',
		),

		/* --- نامک ویژگی‌های ووکامرس (محصولات > ویژگی‌ها) --- */
		'attributes' => array(
			'size'     => 'pa_size',
			'firmness' => 'pa_firmness',
			'warranty' => 'pa_warranty',
			'layer'    => 'pa_layer-layout',
			'spring'   => 'pa_spring-type',
			'special'  => 'pa_special-layer',
			'fabric'   => 'pa_fabric-type',
		),

		/* --- عنوان کاربردی هر سایز --- */
		'size_labels' => array(
			'70x130'  => 'نوزاد',
			'80x180'  => 'نوجوان',
			'90x200'  => 'یک‌نفره',
			'100x200' => '',
			'120x200' => 'یک‌نفره عریض',
			'140x200' => 'دونفره',
			'160x200' => 'کویین',
			'180x200' => 'کینگ',
			'200x200' => 'سوپرکینگ',
		),

		/* --- بازه‌های آماده فیلتر قیمت (تومان؛ max=0 یعنی بدون سقف) --- */
		'price_presets' => array(
			array( 'label' => 'تا ۳۰ میلیون', 'min' => 0, 'max' => 30000000 ),
			array( 'label' => '۳۰ تا ۶۰ میلیون', 'min' => 30000000, 'max' => 60000000 ),
			array( 'label' => '۶۰ تا ۱۲۰ میلیون', 'min' => 60000000, 'max' => 120000000 ),
			array( 'label' => 'بالای ۱۲۰ میلیون', 'min' => 120000000, 'max' => 0 ),
		),

		/* --- دسته‌بندی‌ها و ساختار هسته --- */
		'cores' => array(
			'mattress'          => array( 'key' => 'bonnell', 'title' => 'تشک', 'text' => 'انواع تشک‌های فنری و بدون فنر هیگر در سایزهای یک‌نفره، دونفره، نوجوان و نوزاد.' ),
			'spring'            => array( 'key' => 'bonnell', 'title' => 'تشک فنری', 'text' => 'تشک‌های دارای اسکلت فنر متصل یا فنر منفصل پاکتی.' ),
			'bonnell-spring'    => array( 'key' => 'bonnell', 'title' => 'فنر متصل', 'text' => 'در این نوع تشک، فنرهای هسته به یکدیگر متصل‌اند و یک شبکه یکپارچه می‌سازند.' ),
			'pocket-spring'     => array( 'key' => 'pocket', 'title' => 'فنر منفصل', 'text' => 'فنرهای این نوع تشک هر کدام در یک پاکت جداگانه قرار دارند.' ),
			'no-spring'         => array( 'key' => 'foam', 'title' => 'بدون فنر', 'text' => 'تشک‌های تمام‌فوم و ریباند بدون اسکلت فلزی.' ),
			'rebound'           => array( 'key' => 'rebond', 'title' => 'ریباند', 'text' => 'هسته ریباند از قطعات فوم فشرده‌شده ساخته می‌شود و فنر ندارد.' ),
			'high-density-foam' => array( 'key' => 'foam', 'title' => 'فوم سنگین', 'text' => 'در این نوع تشک، هسته از فوم ساخته شده و فنر ندارد.' ),
			'accessories'       => array( 'key' => 'accessory', 'title' => 'محصولات جانبی', 'text' => 'تاپر و محافظ تشک برای تکمیل و محافظت از سطح تشک.' ),
		),

		/* --- تنظیمات اختصاصی سربرگ (هیرو) هر دسته‌بندی (/product-category/...) ---
		 * هر دسته‌بندی با تم رنگی ملایم، تیتر با بخش طلایی، ویژگی‌های کلیدی، توضیح
		 * اختصاصی و نمای شماتیک ساختار خودش نمایش داده می‌شود. اگر در ووکامرس برای
		 * دسته‌ای تصویر یا توضیح بلند (سئو) ثبت کرده باشید، خودکار استفاده می‌شود.
		 */
		'category_heroes' => array(
			'mattress' => array(
				'theme'       => 'mattress',
				'kicker'      => 'مجموعه تشک‌های هیگر',
				'title'       => 'انواع',
				'accent'      => 'تشک‌های هیگر',
				'title_after' => '',
				'subtitle'    => 'تمامی مدل‌های فنری و بدون فنر هیگر در یک جا؛ بر اساس ساختار هسته، درجه سفتی، سایز تخت و بودجه مقایسه و انتخاب کنید.',
				'highlights'  => array( 'فنری و بدون فنر', 'تولید در سایزهای نوزاد تا سوپرکینگ', 'امکان دوخت سفارشی ابعاد' ),
				'art_label'   => 'کلکسیون کامل تشک‌های هیگر',
				'finder_text' => 'مطمئن نیستید تشک فنری برای شما بهتر است یا بدون فنر؟ با چند سؤال بررسی کنید',
				'show_finder' => true,
			),
			'spring' => array(
				'theme'       => 'bonnell',
				'kicker'      => 'تشک‌های دارای اسکلت فنری',
				'title'       => 'تشک‌های',
				'accent'      => 'فنری',
				'title_after' => 'هیگر',
				'subtitle'    => 'تشک‌های فنری هیگر در دو ساختار فنر متصل (شبکه یکپارچه) و فنر منفصل پاکتی عرضه می‌شوند؛ با گردش هوای مناسب، انعطاف‌پذیری دلپذیر و تنوع کامل در نرمی و قیمت.',
				'highlights'  => array( 'گردش هوای بهتر در هسته', 'انواع فنر متصل و منفصل', 'تنوع بالا از خیلی نرم تا سفت' ),
				'art_label'   => 'مقطع اسکلت تشک فنری',
				'finder_text' => 'بین فنر متصل و فنر منفصل مردد هستید؟ در تشک‌سنج بررسی کنید',
				'show_finder' => true,
			),
			'bonnell-spring' => array(
				'theme'       => 'bonnell',
				'kicker'      => 'زیرمجموعه تشک فنری',
				'title'       => 'تشک‌های',
				'accent'      => 'فنر متصل',
				'title_after' => '',
				'subtitle'    => 'در تشک‌های فنر متصل، فنرهای فولادی هسته به هم متصل‌اند و یک شبکه یکپارچه می‌سازند؛ با تهویه طبیعی هوا، فنریت متعادل و بازه گسترده‌ای از مدل‌های اقتصادی تا حرفه‌ای.',
				'highlights'  => array( 'شبکه فنر یکپارچه و مقاوم', 'تهویه مناسب و خنک‌تر', 'تنوع بالای نرمی و قیمت' ),
				'art_label'   => 'نمای شماتیک هسته فنر متصل',
				'finder_text' => 'مطمئن نیستید کدام مدل فنر متصل با خواب شما جور است؟',
				'show_finder' => true,
			),
			'pocket-spring' => array(
				'theme'       => 'pocket',
				'kicker'      => 'زیرمجموعه تشک فنری',
				'title'       => 'تشک‌های',
				'accent'      => 'فنر منفصل',
				'title_after' => 'پاکتی',
				'subtitle'    => 'هر فنر در یک پاکت پارچه‌ای مستقل قرار دارد و جدا از فنرهای کناری عمل می‌کند؛ مناسب برای کاهش انتقال حرکت در خواب دونفره و تطبیق نقطه‌ای با فرم بدن.',
				'highlights'  => array( 'عملکرد مستقل هر فنر', 'کاهش انتقال حرکت دونفره', 'تطبیق نقطه‌ای با انحنای بدن' ),
				'art_label'   => 'نمای شماتیک هسته فنر منفصل پاکتی',
				'finder_text' => 'برای مقایسه این مدل با سایر ساختارها، تشک‌سنج را امتحان کنید',
				'show_finder' => true,
			),
			'no-spring' => array(
				'theme'       => 'foam',
				'kicker'      => 'تشک‌های بدون اسکلت فلزی',
				'title'       => 'تشک‌های',
				'accent'      => 'بدون فنر',
				'title_after' => '',
				'subtitle'    => 'تشک‌های تمام‌فوم سنگین و ریباند هیگر بدون اسکلت فلزی ساخته می‌شوند؛ سطحی کاملاً بی‌صدا، یکنواخت و پایدار برای کسانی که تکیه‌گاه محکم‌تری می‌پسندند.',
				'highlights'  => array( 'کاملاً بی‌صدا و بدون لرزش', 'شامل فوم سنگین و ریباند', 'پشتیبانی محکم و یکنواخت' ),
				'art_label'   => 'نمای شماتیک هسته بدون فنر',
				'finder_text' => 'بین فوم سنگین و ریباند شک دارید؟ با چند سؤال مقایسه کنید',
				'show_finder' => true,
			),
			'high-density-foam' => array(
				'theme'       => 'foam',
				'kicker'      => 'زیرمجموعه تشک بدون فنر',
				'title'       => 'تشک‌های',
				'accent'      => 'فوم سنگین',
				'title_after' => '',
				'subtitle'    => 'هسته این تشک‌ها از فوم با تراکم بالا ساخته شده و هیچ فنری ندارد؛ سطحی ساکت، یکنواخت و محکم که بدون فرو رفتن بیش‌ازحد، بدن را در یک راستا نگه می‌دارد.',
				'highlights'  => array( 'بدون فنر و کاملاً بی‌صدا', 'فوم پرتراکم با پشتیبانی یکنواخت', 'مناسب علاقه‌مندان سطح سفت' ),
				'art_label'   => 'نمای شماتیک هسته فوم سنگین',
				'finder_text' => 'مطمئن نیستید کدام مدل فوم سنگین مناسب وزن و خواب شماست؟',
				'show_finder' => true,
			),
			'rebound' => array(
				'theme'       => 'rebond',
				'kicker'      => 'زیرمجموعه تشک بدون فنر',
				'title'       => 'تشک‌های',
				'accent'      => 'ریباند',
				'title_after' => '',
				'subtitle'    => 'هسته ریباند از قطعات فشرده‌شده فوم با چگالی بالا تشکیل می‌شود و بدون فنر است؛ گزینه‌ای بادوام و مقاوم در برابر نشست با پشتیبانی بسیار محکم و پایدار.',
				'highlights'  => array( 'فوم فشرده با چگالی بالا', 'مقاومت عالی در برابر نشست', 'حمایت پایدار و بدون صدا' ),
				'art_label'   => 'نمای شماتیک هسته ریباند فشرده',
				'finder_text' => 'ببینید کدام مدل ریباند با فرم خوابیدن شما سازگارتر است',
				'show_finder' => true,
			),
			'accessories' => array(
				'theme'       => 'accessory',
				'kicker'      => 'لوازم تکمیلی کالای خواب',
				'title'       => 'محصولات',
				'accent'      => 'جانبی تشک',
				'title_after' => '',
				'subtitle'    => 'تاپر و محافظ تشک هیگر برای محافظت از سطح تشک، تنظیم نرمی رویه و افزایش عمر مفید تشک در سایزهای استاندارد یک‌نفره تا سوپرکینگ.',
				'highlights'  => array( 'افزایش عمر و بهداشت تشک', 'تنوع کامل سایزهای استاندارد', 'نگهداری و شست‌وشوی آسان' ),
				'art_label'   => 'تاپر و محافظ تشک هیگر',
				'finder_text' => '',
				'show_finder' => false,
			),
		),

		/* --- عناوین نمایشی مقادیر ویژگی‌ها (در صورت نیاز به نام خواناتر) --- */
		'term_titles' => array(
			'pa_spring-type' => array(
				'micro' => 'فنر میکرو',
				'2-2'   => 'فنر ۲٫۲',
			),
			'pa_special-layer' => array(
				'memory-foam'  => 'مموری فوم',
				'eurolux-foam' => 'ابر یورولوکس',
			),
			'pa_fabric-type' => array(
				'circular-knit' => 'گردبافت',
			),
		),
	);
}
endif;


/* ============================================================
   بخش ۲ — توابع کمکی و جمع‌آوری کاتالوگ ووکامرس
   ============================================================ */

if ( ! function_exists( 'higer_cat_fa' ) ) {
	function higer_cat_fa( $value ) {
		return str_replace(
			array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
			array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ),
			(string) $value
		);
	}
}

if ( ! function_exists( 'higer_cat_en_digits' ) ) {
	function higer_cat_en_digits( $value ) {
		return str_replace(
			array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ),
			array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
			(string) $value
		);
	}
}

if ( ! function_exists( 'higer_cat_number' ) ) {
	function higer_cat_number( $amount ) {
		$decimals = function_exists( 'wc_get_price_decimals' ) ? (int) wc_get_price_decimals() : 0;
		return higer_cat_fa( number_format( (float) $amount, $decimals, '.', ',' ) );
	}
}

if ( ! function_exists( 'higer_cat_money' ) ) {
	function higer_cat_money( $amount ) {
		$symbol = function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '';
		$symbol = trim( html_entity_decode( (string) $symbol, ENT_QUOTES, 'UTF-8' ) );
		return higer_cat_number( $amount ) . ' ' . ( '' !== $symbol ? $symbol : 'تومان' );
	}
}

if ( ! function_exists( 'higer_cat_size_parts' ) ) {
	function higer_cat_size_parts( $value ) {
		$norm = higer_cat_en_digits( $value );
		return preg_match( '/^(\d+)\s*(?:x|×|\*|در)\s*(\d+)$/iu', trim( $norm ), $m ) ? array( (int) $m[1], (int) $m[2] ) : null;
	}
}

if ( ! function_exists( 'higer_cat_size_text' ) ) {
	function higer_cat_size_text( $slug, $name ) {
		$parts = higer_cat_size_parts( $slug );
		if ( ! $parts ) {
			$parts = higer_cat_size_parts( $name );
		}
		return $parts ? higer_cat_fa( $parts[0] . '×' . $parts[1] ) : higer_cat_fa( $name );
	}
}

if ( ! function_exists( 'higer_cat_size_compare' ) ) {
	function higer_cat_size_compare( $a, $b ) {
		$pa = higer_cat_size_parts( $a );
		$pb = higer_cat_size_parts( $b );
		if ( ! $pa || ! $pb ) {
			return strcmp( (string) $a, (string) $b );
		}
		return ( $pa[0] === $pb[0] ) ? $pa[1] - $pb[1] : $pa[0] - $pb[0];
	}
}

if ( ! function_exists( 'higer_cat_num_compare' ) ) {
	function higer_cat_num_compare( $a, $b ) {
		$na = preg_match( '/(\d+)/', higer_cat_en_digits( $a ), $ma ) ? (int) $ma[1] : 0;
		$nb = preg_match( '/(\d+)/', higer_cat_en_digits( $b ), $mb ) ? (int) $mb[1] : 0;
		return ( $na === $nb ) ? strcmp( (string) $a, (string) $b ) : ( $na - $nb );
	}
}

if ( ! function_exists( 'higer_cat_terms' ) ) {
	function higer_cat_terms( $product_id, $taxonomy ) {
		if ( ! $taxonomy || ! taxonomy_exists( $taxonomy ) ) {
			return array();
		}
		$terms = wc_get_product_terms( $product_id, $taxonomy, array( 'fields' => 'all' ) );
		return is_array( $terms ) ? array_values( array_filter( $terms, 'is_object' ) ) : array();
	}
}

if ( ! function_exists( 'higer_cat_term_title' ) ) {
	function higer_cat_term_title( $taxonomy, $term, $cfg ) {
		if ( isset( $cfg['term_titles'][ $taxonomy ][ $term->slug ] ) ) {
			return (string) $cfg['term_titles'][ $taxonomy ][ $term->slug ];
		}
		return higer_cat_fa( $term->name );
	}
}

if ( ! function_exists( 'higer_cat_term_url' ) ) {
	function higer_cat_term_url( $term, $taxonomy = 'product_cat' ) {
		$url = $term ? get_term_link( $term, $taxonomy ) : '';
		return ( ! $url || is_wp_error( $url ) ) ? '' : (string) $url;
	}
}

if ( ! function_exists( 'higer_cat_primary_category' ) ) {
	function higer_cat_primary_category( $product_id ) {
		$best  = null;
		$terms = higer_cat_terms( $product_id, 'product_cat' );
		foreach ( $terms as $term ) {
			if ( 'uncategorized' === $term->slug || false !== strpos( urldecode( $term->slug ), 'دسته-بندی-نشده' ) ) {
				continue;
			}
			$ancestors = get_ancestors( $term->term_id, 'product_cat', 'taxonomy' );
			if ( null === $best || count( $ancestors ) > count( $best['ancestors'] ) ) {
				$best = array( 'term' => $term, 'ancestors' => $ancestors );
			}
		}
		if ( ! $best ) {
			return null;
		}
		$path = array();
		foreach ( array_reverse( $best['ancestors'] ) as $aid ) {
			$anc = get_term( $aid, 'product_cat' );
			if ( $anc && ! is_wp_error( $anc ) ) {
				$path[] = $anc;
			}
		}
		$path[] = $best['term'];
		return array( 'term' => $best['term'], 'path' => $path );
	}
}

if ( ! function_exists( 'higer_cat_core_for' ) ) {
	function higer_cat_core_for( $path, $cfg ) {
		foreach ( array_reverse( (array) $path ) as $term ) {
			if ( isset( $cfg['cores'][ $term->slug ] ) ) {
				return $cfg['cores'][ $term->slug ] + array( 'slug' => $term->slug );
			}
		}
		return null;
	}
}

if ( ! function_exists( 'higer_cat_firmness_max' ) ) {
	function higer_cat_firmness_max( $taxonomy ) {
		static $cache = array();
		if ( isset( $cache[ $taxonomy ] ) ) {
			return $cache[ $taxonomy ];
		}
		$max = 4;
		if ( taxonomy_exists( $taxonomy ) ) {
			$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => false ) );
			if ( is_array( $terms ) ) {
				$levels = array();
				foreach ( $terms as $t ) {
					if ( preg_match( '/(\d+)$/', $t->slug, $m ) ) {
						$levels[] = (int) $m[1];
					}
				}
				if ( $levels ) {
					$max = max( $levels );
				}
			}
		}
		$cache[ $taxonomy ] = $max;
		return $max;
	}
}

if ( ! function_exists( 'higer_cat_collect_product' ) ) {
	function higer_cat_collect_product( $item, $cfg, $index = 0 ) {
		$id       = (int) $item->get_id();
		$keys     = $cfg['attributes'];
		$variable = $item->is_type( 'variable' );
		$short    = trim( wp_strip_all_tags( (string) $item->get_short_description() ) );
		$cat_info = higer_cat_primary_category( $id );
		$core     = $cat_info ? higer_cat_core_for( $cat_info['path'], $cfg ) : null;

		/* همه دسته‌های محصول به همراه والدها برای فیلتر درختی */
		$cat_slugs = array();
		$cat_names = array();
		foreach ( higer_cat_terms( $id, 'product_cat' ) as $ct ) {
			if ( 'uncategorized' === $ct->slug || false !== strpos( urldecode( $ct->slug ), 'دسته-بندی-نشده' ) ) {
				continue;
			}
			$cat_slugs[] = $ct->slug;
			$cat_names[] = $ct->name;
			foreach ( (array) get_ancestors( $ct->term_id, 'product_cat', 'taxonomy' ) as $aid ) {
				$anc = get_term( $aid, 'product_cat' );
				if ( $anc && ! is_wp_error( $anc ) ) {
					$cat_slugs[] = $anc->slug;
					$cat_names[] = $anc->name;
				}
			}
		}
		$cat_slugs = array_values( array_unique( $cat_slugs ) );
		$cat_names = array_values( array_unique( $cat_names ) );

		/* سایزها و قیمت هر سایز */
		$size_tax = $keys['size'];
		$size_key = sanitize_title( $size_tax );
		$size_map = array();
		foreach ( higer_cat_terms( $id, $size_tax ) as $st ) {
			$size_map[ $st->slug ] = array(
				'label'       => higer_cat_size_text( $st->slug, $st->name ),
				'sub'         => isset( $cfg['size_labels'][ $st->slug ] ) ? $cfg['size_labels'][ $st->slug ] : '',
				'vid'         => 0,
				'price'       => 0.0,
				'priceText'   => '',
				'regularText' => '',
				'inStock'     => (bool) $item->is_in_stock(),
			);
		}

		if ( $variable ) {
			$vars = (array) $item->get_available_variations();
			if ( $vars ) {
				$any_var = null;
				foreach ( $vars as $v ) {
					if ( isset( $v['variation_is_active'] ) && ! $v['variation_is_active'] ) {
						continue;
					}
					$v_size = '';
					foreach ( (array) $v['attributes'] as $ak => $av ) {
						$clean_k = preg_replace( '/^attribute_/', '', (string) $ak );
						if ( $clean_k === $size_tax || $clean_k === $size_key ) {
							$v_size = (string) $av;
						}
					}
					$vp = (float) $v['display_price'];
					$vr = isset( $v['display_regular_price'] ) ? (float) $v['display_regular_price'] : $vp;
					$vi = ! empty( $v['is_in_stock'] );
					$entry = array(
						'vid'         => (int) $v['variation_id'],
						'price'       => $vp,
						'priceText'   => $vp > 0 ? higer_cat_money( $vp ) : '',
						'regularText' => $vr > $vp ? higer_cat_money( $vr ) : '',
						'inStock'     => $vi,
					);
					if ( '' === $v_size ) {
						if ( null === $any_var || $vp < $any_var['price'] ) {
							$any_var = $entry;
						}
					} else {
						if ( ! isset( $size_map[ $v_size ] ) ) {
							$size_map[ $v_size ] = array(
								'label' => higer_cat_size_text( $v_size, $v_size ),
								'sub'   => isset( $cfg['size_labels'][ $v_size ] ) ? $cfg['size_labels'][ $v_size ] : '',
							) + $entry;
						} elseif ( 0.0 === $size_map[ $v_size ]['price'] || $vp < $size_map[ $v_size ]['price'] ) {
							$size_map[ $v_size ] = array_merge( $size_map[ $v_size ], $entry );
						} elseif ( $vi ) {
							$size_map[ $v_size ]['inStock'] = true;
						}
					}
				}
				if ( null !== $any_var ) {
					foreach ( $size_map as $sk => $sv ) {
						if ( 0.0 === $sv['price'] ) {
							$size_map[ $sk ] = array_merge( $sv, $any_var );
						}
					}
				}
			}
			$min = (float) $item->get_variation_price( 'min', true );
			$max = (float) $item->get_variation_price( 'max', true );
		} else {
			$min = (float) wc_get_price_to_display( $item );
			$max = $min;
		}
		if ( $size_map ) {
			uksort( $size_map, 'higer_cat_size_compare' );
		}

		/* سفتی، گارانتی، چیدمان لایه‌ها، نوع فنر، لایه ویژه، جنس پارچه */
		$firm_terms = higer_cat_terms( $id, $keys['firmness'] );
		$firm       = $firm_terms ? $firm_terms[0] : null;
		$firm_max   = higer_cat_firmness_max( $keys['firmness'] );
		$firm_level = ( $firm && preg_match( '/(\d+)$/', $firm->slug, $fm ) ) ? (int) $fm[1] : 0;

		$war_terms = higer_cat_terms( $id, $keys['warranty'] );
		$war       = $war_terms ? $war_terms[0] : null;
		$war_years = ( $war && preg_match( '/(\d+)/', higer_cat_en_digits( $war->slug . ' ' . $war->name ), $wm ) ) ? (int) $wm[1] : 0;

		$lay_terms = higer_cat_terms( $id, $keys['layer'] );
		$lay       = $lay_terms ? $lay_terms[0] : null;

		$multi_groups = array( 'spring', 'special', 'fabric' );
		$multi_data   = array();
		foreach ( $multi_groups as $gk ) {
			$tax               = $keys[ $gk ];
			$multi_data[ $gk ] = array();
			foreach ( higer_cat_terms( $id, $tax ) as $mt ) {
				$multi_data[ $gk ][] = array(
					'slug' => $mt->slug,
					'name' => higer_cat_term_title( $tax, $mt, $cfg ),
				);
			}
		}

		/* ویژگی‌های سراسری اضافی احتمالی در آینده */
		$known_tax = array_values( $keys );
		$extra     = array();
		foreach ( (array) $item->get_attributes() as $attribute ) {
			if ( ! is_object( $attribute ) || ! $attribute->get_visible() || ! $attribute->is_taxonomy() ) {
				continue;
			}
			$aname = $attribute->get_name();
			if ( in_array( $aname, $known_tax, true ) ) {
				continue;
			}
			$aterms = (array) $attribute->get_terms();
			if ( $aterms ) {
				$extra[ $aname ] = array(
					'label' => wc_attribute_label( $aname, $item ),
					'items' => array(),
				);
				foreach ( $aterms as $at ) {
					if ( is_object( $at ) ) {
						$extra[ $aname ]['items'][] = array( 'slug' => $at->slug, 'name' => higer_cat_fa( $at->name ) );
					}
				}
			}
		}

		$image_id = (int) $item->get_image_id();
		$image    = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : '';
		$size_lbl = array_values( wp_list_pluck( $size_map, 'label' ) );
		$size_sum = $size_lbl ? ( 1 === count( $size_lbl ) ? $size_lbl[0] : higer_cat_fa( count( $size_lbl ) ) . ' سایز: ' . $size_lbl[0] . ' تا ' . $size_lbl[ count( $size_lbl ) - 1 ] ) : '';
		$range    = $min > 0 ? ( $max > $min ? higer_cat_number( $min ) . ' تا ' . higer_cat_money( $max ) : higer_cat_money( $min ) ) : 'تماس بگیرید';

		/* رشته جستجوی جامع (انگلیسی + فارسی + کد + دسته‌ها + ویژگی‌ها) */
		$search_parts = array(
			$item->get_name(),
			$short,
			(string) $item->get_sku(),
			implode( ' ', $cat_names ),
			$core ? $core['title'] : '',
			$firm ? $firm->name : '',
			$war ? higer_cat_fa( $war->name ) : '',
			$lay ? $lay->name : '',
			implode( ' ', $size_lbl ),
		);
		foreach ( $multi_data as $md ) {
			foreach ( $md as $mi ) {
				$search_parts[] = $mi['name'];
			}
		}
		foreach ( $extra as $ex ) {
			foreach ( $ex['items'] as $ei ) {
				$search_parts[] = $ei['name'];
			}
		}
		$search_blob = trim( preg_replace( '/\s+/u', ' ', implode( ' ', $search_parts ) ) );
		$search_blob = function_exists( 'mb_strtolower' ) ? mb_strtolower( $search_blob, 'UTF-8' ) : strtolower( $search_blob );

		return array(
			'id'         => $id,
			'order'      => $index,
			'slug'       => (string) $item->get_slug(),
			'name'       => (string) $item->get_name(),
			'short'      => $short,
			'url'        => (string) $item->get_permalink(),
			'sku'        => (string) $item->get_sku(),
			'variable'   => $variable,
			'inStock'    => (bool) $item->is_in_stock(),
			'purchasable'=> (bool) $item->is_purchasable(),
			'onSale'     => (bool) $item->is_on_sale(),
			'minQty'     => max( 1, (int) $item->get_min_purchase_quantity() ),
			'image'      => $image ? (string) $image : '',
			'min'        => $min,
			'max'        => $max,
			'rangeText'  => $range,
			'catSlugs'   => $cat_slugs,
			'primaryCat' => $cat_info ? array(
				'slug' => $cat_info['term']->slug,
				'name' => $cat_info['term']->name,
				'url'  => higer_cat_term_url( $cat_info['term'], 'product_cat' ),
			) : null,
			'core'       => $core ? array( 'key' => $core['key'], 'title' => $core['title'], 'slug' => $core['slug'] ) : array( 'key' => 'generic', 'title' => '', 'slug' => '' ),
			'sizeKey'    => $size_key,
			'sizes'      => $size_map,
			'sizeSum'    => $size_sum,
			'firmness'   => $firm ? array( 'slug' => $firm->slug, 'name' => $firm->name, 'level' => $firm_level, 'max' => $firm_max ) : null,
			'warranty'   => $war ? array( 'slug' => $war->slug, 'name' => higer_cat_fa( $war->name ), 'years' => $war_years ) : null,
			'layer'      => $lay ? array( 'slug' => $lay->slug, 'name' => $lay->name ) : null,
			'spring'     => $multi_data['spring'],
			'special'    => $multi_data['special'],
			'fabric'     => $multi_data['fabric'],
			'extra'      => $extra,
			'search'     => $search_blob,
		);
	}
}

if ( ! function_exists( 'higer_cat_build_categories' ) ) {
	function higer_cat_build_categories( $products ) {
		if ( ! taxonomy_exists( 'product_cat' ) ) {
			return array();
		}
		$terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false ) );
		if ( ! is_array( $terms ) ) {
			return array();
		}
		$by_id = array();
		foreach ( $terms as $t ) {
			if ( ! is_object( $t ) || 'uncategorized' === $t->slug || false !== strpos( urldecode( $t->slug ), 'دسته-بندی-نشده' ) ) {
				continue;
			}
			$cnt      = 0;
			$in_stock = 0;
			foreach ( $products as $p ) {
				if ( in_array( $t->slug, $p['catSlugs'], true ) ) {
					$cnt++;
					if ( ! empty( $p['inStock'] ) ) {
						$in_stock++;
					}
				}
			}
			if ( $cnt < 1 ) {
				continue;
			}
			$by_id[ (int) $t->term_id ] = array(
				'id'           => (int) $t->term_id,
				'slug'         => $t->slug,
				'name'         => $t->name,
				'parent'       => (int) $t->parent,
				'depth'        => 0,
				'count'        => $cnt,
				'inStockCount' => $in_stock,
				'url'          => higer_cat_term_url( $t, 'product_cat' ),
			);
		}
		$flat = array();
		$walk = function ( $parent_id, $depth ) use ( &$walk, &$by_id, &$flat ) {
			foreach ( $by_id as $node ) {
				if ( $node['parent'] === $parent_id ) {
					$node['depth'] = $depth;
					$flat[]        = $node;
					$walk( $node['id'], $depth + 1 );
				}
			}
		};
		$walk( 0, 0 );
		return $flat;
	}
}

if ( ! function_exists( 'higer_cat_catalog' ) ) {
	/** کل کاتالوگ فروشگاه و گزینه‌های فیلتر را جمع‌آوری و کش می‌کند. */
	function higer_cat_catalog( $cfg ) {
		$hours  = isset( $cfg['shop_cache'] ) ? (float) $cfg['shop_cache'] : 0;
		$ckey   = '';
		$cached = false;
		if ( $hours > 0 && function_exists( 'get_transient' ) ) {
			$ver    = class_exists( 'WC_Cache_Helper' ) ? WC_Cache_Helper::get_transient_version( 'product' ) : '';
			$ckey   = 'higer_cat_' . md5( wp_json_encode( array( 3, $ver, $cfg['attributes'], $cfg['size_labels'], $cfg['cores'], $cfg['term_titles'] ) ) );
			$cached = get_transient( $ckey );
		}
		if ( is_array( $cached ) && isset( $cached['products'] ) ) {
			return $cached;
		}
		if ( ! function_exists( 'wc_get_products' ) ) {
			return array( 'products' => array(), 'categories' => array(), 'facets' => array(), 'minPrice' => 0, 'maxPrice' => 0, 'hasSale' => false );
		}

		$raw = wc_get_products( array(
			'status'     => 'publish',
			'limit'      => -1,
			'visibility' => 'catalog',
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
		) );

		$products   = array();
		$global_min = null;
		$global_max = 0.0;
		$has_sale   = false;
		$idx        = 0;

		foreach ( (array) $raw as $item ) {
			if ( ! is_object( $item ) || ! method_exists( $item, 'get_id' ) ) {
				continue;
			}
			$p          = higer_cat_collect_product( $item, $cfg, $idx++ );
			$products[] = $p;
			if ( $p['min'] > 0 && ( null === $global_min || $p['min'] < $global_min ) ) {
				$global_min = $p['min'];
			}
			if ( $p['max'] > $global_max ) {
				$global_max = $p['max'];
			}
			if ( $p['onSale'] ) {
				$has_sale = true;
			}
		}

		/* استخراج گزینه‌های همه فیلترها از محصولات موجود در کاتالوگ */
		$sizes     = array();
		$firmness  = array();
		$layers    = array();
		$warranty  = array();
		$springs   = array();
		$specials  = array();
		$fabrics   = array();
		$extras    = array();

		foreach ( $products as $p ) {
			foreach ( $p['sizes'] as $sk => $sv ) {
				if ( ! isset( $sizes[ $sk ] ) ) {
					$sizes[ $sk ] = array( 'slug' => $sk, 'label' => $sv['label'], 'sub' => $sv['sub'] );
				}
			}
			if ( $p['firmness'] ) {
				$f                     = $p['firmness'];
				$firmness[ $f['slug'] ] = $f;
			}
			if ( $p['layer'] ) {
				$l                    = $p['layer'];
				$layers[ $l['slug'] ] = $l;
			}
			if ( $p['warranty'] ) {
				$w                      = $p['warranty'];
				$warranty[ $w['slug'] ] = $w;
			}
			foreach ( $p['spring'] as $sp ) {
				$springs[ $sp['slug'] ] = $sp;
			}
			foreach ( $p['special'] as $sl ) {
				$specials[ $sl['slug'] ] = $sl;
			}
			foreach ( $p['fabric'] as $fb ) {
				$fabrics[ $fb['slug'] ] = $fb;
			}
			foreach ( $p['extra'] as $tax => $ex ) {
				if ( ! isset( $extras[ $tax ] ) ) {
					$extras[ $tax ] = array( 'tax' => $tax, 'label' => $ex['label'], 'terms' => array() );
				}
				foreach ( $ex['items'] as $ei ) {
					$extras[ $tax ]['terms'][ $ei['slug'] ] = $ei;
				}
			}
		}

		uksort( $sizes, 'higer_cat_size_compare' );
		uasort( $firmness, function ( $a, $b ) { return $a['level'] - $b['level']; } );
		uksort( $warranty, 'higer_cat_num_compare' );
		foreach ( $extras as $tax => $ex ) {
			$extras[ $tax ]['terms'] = array_values( $ex['terms'] );
		}

		$out = array(
			'products'   => $products,
			'categories' => higer_cat_build_categories( $products ),
			'facets'     => array(
				'sizes'    => array_values( $sizes ),
				'firmness' => array_values( $firmness ),
				'layers'   => array_values( $layers ),
				'warranty' => array_values( $warranty ),
				'spring'   => array_values( $springs ),
				'special'  => array_values( $specials ),
				'fabric'   => array_values( $fabrics ),
				'extra'    => array_values( $extras ),
			),
			'minPrice'   => null !== $global_min ? (float) $global_min : 0.0,
			'maxPrice'   => (float) $global_max,
			'hasSale'    => $has_sale,
		);

		if ( $ckey && function_exists( 'set_transient' ) ) {
			set_transient( $ckey, $out, (int) round( $hours * 3600 ) );
		}
		return $out;
	}
}

if ( ! function_exists( 'higer_cat_scope_catalog' ) ) {
	/**
	 * استخراج محصولات، فیلترهای واقعی، بازه قیمت، آمار و زیردسته‌ها/هم‌رده‌های
	 * مختص به یک دسته‌بندی از روی کاتالوگ کش‌شده (بدون کوئری اضافه به دیتابیس).
	 */
	function higer_cat_scope_catalog( $catalog, $cat_slug, $cfg ) {
		$all_products = (array) $catalog['products'];
		$all_cats     = (array) $catalog['categories'];
		$hide_out     = ! empty( $cfg['hide_out_of_stock'] );

		$cat_by_slug = array();
		$cat_by_id   = array();
		foreach ( $all_cats as $c ) {
			$cat_by_slug[ $c['slug'] ] = $c;
			$cat_by_id[ $c['id'] ]     = $c;
		}
		$current = isset( $cat_by_slug[ $cat_slug ] ) ? $cat_by_slug[ $cat_slug ] : null;

		$products  = array();
		$min_price = null;
		$max_price = 0.0;
		$has_sale  = false;
		$sizes     = array();
		$firmness  = array();
		$layers    = array();
		$warranty  = array();
		$springs   = array();
		$specials  = array();
		$fabrics   = array();
		$extras    = array();

		$in_stock_cnt  = 0;
		$stat_min      = null;
		$stat_firms    = array();
		$stat_war_min  = null;
		$stat_war_max  = 0;

		foreach ( $all_products as $p ) {
			if ( ! in_array( $cat_slug, (array) $p['catSlugs'], true ) ) {
				continue;
			}
			$products[] = $p;

			if ( $p['min'] > 0 && ( null === $min_price || $p['min'] < $min_price ) ) {
				$min_price = (float) $p['min'];
			}
			if ( $p['max'] > $max_price ) {
				$max_price = (float) $p['max'];
			}
			if ( $p['onSale'] ) {
				$has_sale = true;
			}
			if ( $p['inStock'] ) {
				$in_stock_cnt++;
			}

			$count_for_stats = $p['inStock'] || ! $hide_out;
			if ( $count_for_stats ) {
				if ( $p['min'] > 0 && ( null === $stat_min || $p['min'] < $stat_min ) ) {
					$stat_min = (float) $p['min'];
				}
				if ( ! empty( $p['firmness'] ) && ! empty( $p['firmness']['level'] ) ) {
					$stat_firms[ (int) $p['firmness']['level'] ] = $p['firmness']['name'];
				}
				if ( ! empty( $p['warranty'] ) && ! empty( $p['warranty']['years'] ) ) {
					$wy = (int) $p['warranty']['years'];
					if ( null === $stat_war_min || $wy < $stat_war_min ) {
						$stat_war_min = $wy;
					}
					if ( $wy > $stat_war_max ) {
						$stat_war_max = $wy;
					}
				}
			}

			foreach ( (array) $p['sizes'] as $sk => $sv ) {
				if ( ! isset( $sizes[ $sk ] ) ) {
					$sizes[ $sk ] = array( 'slug' => $sk, 'label' => $sv['label'], 'sub' => $sv['sub'] );
				}
			}
			if ( ! empty( $p['firmness'] ) ) {
				$firmness[ $p['firmness']['slug'] ] = $p['firmness'];
			}
			if ( ! empty( $p['layer'] ) ) {
				$layers[ $p['layer']['slug'] ] = $p['layer'];
			}
			if ( ! empty( $p['warranty'] ) ) {
				$warranty[ $p['warranty']['slug'] ] = $p['warranty'];
			}
			foreach ( (array) $p['spring'] as $sp ) {
				$springs[ $sp['slug'] ] = $sp;
			}
			foreach ( (array) $p['special'] as $sl ) {
				$specials[ $sl['slug'] ] = $sl;
			}
			foreach ( (array) $p['fabric'] as $fb ) {
				$fabrics[ $fb['slug'] ] = $fb;
			}
			foreach ( (array) $p['extra'] as $tax => $ex ) {
				if ( ! isset( $extras[ $tax ] ) ) {
					$extras[ $tax ] = array( 'tax' => $tax, 'label' => $ex['label'], 'terms' => array() );
				}
				foreach ( $ex['items'] as $ei ) {
					$extras[ $tax ]['terms'][ $ei['slug'] ] = $ei;
				}
			}
		}

		uksort( $sizes, 'higer_cat_size_compare' );
		uasort( $firmness, function ( $a, $b ) { return (int) $a['level'] - (int) $b['level']; } );
		uksort( $warranty, 'higer_cat_num_compare' );
		foreach ( $extras as $tax => $ex ) {
			$extras[ $tax ]['terms'] = array_values( $ex['terms'] );
		}

		/* زیردسته‌ها (فرزندان و نوه‌ها) + هم‌رده‌ها (فرزندان همان والد) */
		$sub_cats     = array();
		$sibling_cats = array();
		$parent_cat   = null;
		if ( $current ) {
			$cur_id    = (int) $current['id'];
			$cur_depth = (int) $current['depth'];
			$parent_id = (int) $current['parent'];
			if ( $parent_id > 0 && isset( $cat_by_id[ $parent_id ] ) ) {
				$parent_cat = $cat_by_id[ $parent_id ];
			}
			$desc_ids = array( $cur_id => true );
			foreach ( $all_cats as $c ) {
				if ( isset( $desc_ids[ (int) $c['parent'] ] ) ) {
					$desc_ids[ (int) $c['id'] ] = true;
					$copy                       = $c;
					$copy['depth']              = max( 0, (int) $c['depth'] - $cur_depth - 1 );
					$sub_cats[]                 = $copy;
				}
				if ( (int) $c['parent'] === $parent_id ) {
					$sibling_cats[] = $c;
				}
			}
		}

		/* بازه‌های قیمت آماده متناسب با محدوده همین دسته‌بندی */
		$eff_min = null !== $min_price ? $min_price : 0.0;
		$presets = array();
		if ( $max_price > $eff_min ) {
			foreach ( (array) $cfg['price_presets'] as $pr ) {
				$pmin = (float) $pr['min'];
				$pmax = (float) $pr['max'];
				$overlaps = ( $pmax <= 0 || $pmax > $eff_min ) && $pmin < $max_price;
				$covers_all = $pmin <= $eff_min && ( $pmax <= 0 || $pmax >= $max_price );
				if ( $overlaps && ! $covers_all ) {
					$presets[] = $pr;
				}
			}
		}

		/* آمار مختصر و واقعی سربرگ دسته‌بندی */
		$shown_total = $hide_out ? $in_stock_cnt : count( $products );
		$stats       = array();
		$stats[]     = array(
			'label' => $hide_out ? 'مدل‌های موجود' : 'تعداد مدل',
			'value' => higer_cat_fa( $shown_total ) . ' مدل',
			'attr'  => 'data-hc-cat-stat-count',
		);
		if ( null !== $stat_min && $stat_min > 0 ) {
			$stats[] = array(
				'label' => 'شروع قیمت',
				'value' => higer_cat_money( $stat_min ),
				'attr'  => '',
			);
		}
		if ( ! empty( $stat_firms ) ) {
			ksort( $stat_firms );
			$vals    = array_values( $stat_firms );
			$f_text  = count( $vals ) > 1 ? $vals[0] . ' تا ' . $vals[ count( $vals ) - 1 ] : $vals[0];
			$stats[] = array(
				'label' => 'درجه سفتی',
				'value' => $f_text,
				'attr'  => '',
			);
		}
		if ( $stat_war_max > 0 ) {
			$w_text  = ( null !== $stat_war_min && $stat_war_min !== $stat_war_max )
				? higer_cat_fa( $stat_war_min ) . ' تا ' . higer_cat_fa( $stat_war_max ) . ' سال'
				: higer_cat_fa( $stat_war_max ) . ' سال';
			$stats[] = array(
				'label' => 'گارانتی رسمی',
				'value' => $w_text,
				'attr'  => '',
			);
		} elseif ( ! empty( $sizes ) ) {
			$stats[] = array(
				'label' => 'تنوع سایز',
				'value' => higer_cat_fa( count( $sizes ) ) . ' سایز',
				'attr'  => '',
			);
		}

		return array(
			'products'     => $products,
			'inStockCount' => $in_stock_cnt,
			'totalCount'   => count( $products ),
			'subCats'      => $sub_cats,
			'siblings'     => $sibling_cats,
			'parentCat'    => $parent_cat,
			'currentCat'   => $current,
			'presets'      => $presets,
			'stats'        => $stats,
			'facets'       => array(
				'sizes'    => array_values( $sizes ),
				'firmness' => array_values( $firmness ),
				'layers'   => array_values( $layers ),
				'warranty' => array_values( $warranty ),
				'spring'   => array_values( $springs ),
				'special'  => array_values( $specials ),
				'fabric'   => array_values( $fabrics ),
				'extra'    => array_values( $extras ),
			),
			'minPrice'     => $eff_min,
			'maxPrice'     => $max_price,
			'hasSale'      => $has_sale,
			'hasFirmness'  => ! empty( $firmness ),
			'hasWarranty'  => ! empty( $warranty ),
		);
	}
}

if ( ! function_exists( 'higer_cat_icon' ) ) {
	function higer_cat_icon( $name, $size = 18 ) {
		static $paths = array(
			'search'        => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
			'sliders'       => '<line x1="4" x2="4" y1="21" y2="14"/><line x1="4" x2="4" y1="10" y2="3"/><line x1="12" x2="12" y1="21" y2="12"/><line x1="12" x2="12" y1="8" y2="3"/><line x1="20" x2="20" y1="21" y2="16"/><line x1="20" x2="20" y1="12" y2="3"/><line x1="2" x2="6" y1="14" y2="14"/><line x1="10" x2="14" y1="8" y2="8"/><line x1="18" x2="22" y1="16" y2="16"/>',
			'grid'          => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>',
			'list'          => '<line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/>',
			'close'         => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
			'check'         => '<path d="M20 6 9 17l-5-5"/>',
			'compare'       => '<path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/>',
			'sparkles'      => '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>',
			'shield'        => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
			'layers'        => '<path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>',
			'ruler'         => '<path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/>',
			'gauge'         => '<path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
			'bed'           => '<path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"/><path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/><path d="M12 4v6"/><path d="M2 18h20"/>',
			'spring'        => '<path d="M6 3h12"/><path d="M6 21h12"/><path d="M7 3l10 3-10 3 10 3-10 3 10 3-3 3"/>',
			'cloud'         => '<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>',
			'fabric'        => '<path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>',
			'phone'         => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'cart'          => '<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>',
			'eye'           => '<path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/>',
			'chevron-left'  => '<path d="m15 18-6-6 6-6"/>',
			'chevron-down'  => '<path d="m6 9 6 6 6-6"/>',
			'reset'         => '<path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>',
			'map'           => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
			'clock'         => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
			'plus'          => '<path d="M5 12h14"/><path d="M12 5v14"/>',
			'minus'         => '<path d="M5 12h14"/>',
		);
		if ( ! isset( $paths[ $name ] ) ) {
			return '';
		}
		$size = (int) $size;
		return '<svg class="hc-i" xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
	}
}

if ( ! function_exists( 'higer_cat_core_svg' ) ) {
	function higer_cat_core_svg( $key ) {
		$out = '';
		switch ( $key ) {
			case 'bonnell':
				$out .= '<rect x="14" y="30" width="292" height="10" rx="5" fill="#f3d98b" opacity=".9"/><rect x="14" y="140" width="292" height="10" rx="5" fill="#f3d98b" opacity=".9"/>';
				for ( $i = 0; $i < 7; $i++ ) {
					$x    = 38 + $i * 41;
					$out .= '<g fill="none" stroke="#e7b95c" stroke-width="2.4" stroke-linejoin="round"><ellipse cx="' . $x . '" cy="50" rx="15" ry="5" fill="rgba(217,161,59,.22)"/><path d="M' . ( $x - 15 ) . ' 50 L' . ( $x - 4 ) . ' 74 L' . ( $x + 9 ) . ' 90 L' . ( $x - 9 ) . ' 106 L' . ( $x + 4 ) . ' 122 L' . ( $x + 15 ) . ' 130"/><ellipse cx="' . $x . '" cy="130" rx="15" ry="5" fill="rgba(217,161,59,.22)"/></g>';
				}
				$out .= '<path d="M23 50 H297 M23 130 H297" stroke="#d9a13b" stroke-width="1.4" opacity=".55"/>';
				break;
			case 'pocket':
				$out .= '<rect x="12" y="22" width="296" height="136" rx="14" fill="none" stroke="#f3d98b" stroke-width="2" stroke-dasharray="6 5" opacity=".6"/>';
				for ( $i = 0; $i < 7; $i++ ) {
					$x    = 24 + $i * 40;
					$out .= '<rect x="' . $x . '" y="34" width="32" height="112" rx="12" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.8"/><path d="M' . ( $x + 8 ) . ' 46 L' . ( $x + 24 ) . ' 58 L' . ( $x + 8 ) . ' 70 L' . ( $x + 24 ) . ' 82 L' . ( $x + 8 ) . ' 94 L' . ( $x + 24 ) . ' 106 L' . ( $x + 8 ) . ' 118 L' . ( $x + 24 ) . ' 132" fill="none" stroke="#d9a13b" stroke-width="2"/>';
				}
				break;
			case 'rebond':
				$out  .= '<rect x="14" y="30" width="292" height="120" rx="16" fill="rgba(138,109,59,.3)" stroke="#e7b95c" stroke-width="2"/>';
				$chips = array( array( 40, 52, 8, '#d9a13b' ), array( 74, 96, 6, '#f3d98b' ), array( 102, 60, 9, '#8a6d3b' ), array( 132, 118, 7, '#d9a13b' ), array( 160, 70, 6, '#f3d98b' ), array( 186, 128, 8, '#a86f1c' ), array( 214, 58, 7, '#e7b95c' ), array( 244, 104, 9, '#8a6d3b' ), array( 272, 64, 6, '#d9a13b' ), array( 286, 128, 7, '#f3d98b' ), array( 52, 130, 7, '#a86f1c' ), array( 118, 84, 5, '#e7b95c' ), array( 206, 92, 5, '#d9a13b' ), array( 258, 138, 5, '#f3d98b' ) );
				foreach ( $chips as $c ) {
					$out .= '<circle cx="' . $c[0] . '" cy="' . $c[1] . '" r="' . $c[2] . '" fill="' . $c[3] . '" opacity=".9"/>';
				}
				break;
			case 'foam':
				$out .= '<path d="M14 40 C 90 26, 230 54, 306 40 L306 76 C 230 90, 90 62, 14 76 Z" fill="rgba(91,122,78,.45)" stroke="#a8c793" stroke-width="1.8"/>';
				$out .= '<path d="M14 84 C 90 70, 230 98, 306 84 L306 116 C 230 130, 90 102, 14 116 Z" fill="rgba(217,161,59,.25)" stroke="#e7b95c" stroke-width="1.8"/>';
				$out .= '<path d="M14 124 C 90 110, 230 138, 306 124 L306 146 C 230 160, 90 132, 14 146 Z" fill="rgba(243,217,139,.16)" stroke="#f3d98b" stroke-width="1.6"/>';
				break;
			default:
				$out .= '<rect x="34" y="52" width="252" height="24" rx="12" fill="rgba(243,217,139,.25)" stroke="#f3d98b" stroke-width="2"/>';
				$out .= '<rect x="20" y="84" width="280" height="64" rx="16" fill="rgba(217,161,59,.12)" stroke="#e7b95c" stroke-width="2"/>';
				$out .= '<path d="M50 102 H270 M50 117 H270 M50 132 H270" stroke="#e7b95c" stroke-width="1.2" opacity=".5"/>';
		}
		return '<svg class="hc-core-svg" viewBox="0 0 320 180" aria-hidden="true" focusable="false">' . $out . '</svg>';
	}
}

if ( ! function_exists( 'higer_cat_assets' ) ) {
	function higer_cat_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		ob_start();
		?>
<style id="higer-cat-css">
/* ================== هیگر — استایل صفحه فروشگاه و آرشیو محصولات (نسخه بدون بیلد) ================== */
.higer-cat{
  --hc-navy-950:#070f1d;--hc-navy-900:#10243e;--hc-navy-800:#183250;--hc-navy-700:#1f3e63;--hc-navy-600:#2b4e77;
  --hc-gold-600:#c8892a;--hc-gold-500:#d9a13b;--hc-gold-400:#e7b95c;--hc-gold-300:#f3d98b;--hc-gold-200:#f8ead0;
  --hc-cream:#faf7ef;--hc-paper:#f3efe3;--hc-line:#e3ddcd;--hc-ok:#047857;--hc-bad:#b91c1c;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--hc-navy-900);background:var(--hc-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-cat *,.higer-cat *::before,.higer-cat *::after{box-sizing:border-box}
.higer-cat :is(h1,h2,h3,h4,p,ul,ol,figure,table){margin:0;padding:0;border:0}
.higer-cat :is(h1,h2,h3,h4){font-family:inherit;color:inherit;letter-spacing:normal;text-transform:none;font-weight:900;line-height:1.5}
.higer-cat :is(ul,ol){list-style:none}
.higer-cat a{color:inherit;text-decoration:none;background:none}
.higer-cat button{font:inherit;color:inherit;background:none;border:0;border-radius:0;padding:0;margin:0;cursor:pointer;text-transform:none;letter-spacing:normal;box-shadow:none;line-height:inherit;min-height:0;width:auto;white-space:normal;text-align:inherit}
.higer-cat img{display:block;max-width:100%;height:auto;border:0}
.higer-cat svg{flex:none}
.higer-cat .hc-i{display:inline-block;vertical-align:middle}
.higer-cat [hidden]{display:none!important}
.higer-cat :focus-visible{outline:3px solid var(--hc-gold-600);outline-offset:3px}
.higer-cat .hc-wrap{width:100%;max-width:1320px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-cat .hc-wrap{padding-inline:24px}}
.higer-cat .hc-sr{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}

/* ---------- نشان‌ها و دکمه‌های مشترک ---------- */
.higer-cat .hc-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.78);color:var(--hc-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800;line-height:1.6}
.higer-cat .hc-kicker.is-dark{background:rgba(7,15,29,.55);color:var(--hc-gold-300);border-color:rgba(217,161,59,.4)}
.higer-cat .hc-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-cat :is(a,button).hc-btn-gold{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:8px;overflow:hidden;border:0;border-radius:9999px;padding:12px 22px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hc-navy-900);font-size:13px;font-weight:900;line-height:1.4;white-space:nowrap;box-shadow:0 10px 24px rgba(217,161,59,.35),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .2s,filter .2s}
.higer-cat :is(a,button).hc-btn-gold:is(:hover,:focus){background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hc-navy-900)}
.higer-cat :is(a,button).hc-btn-gold:hover{transform:translateY(-2px);filter:brightness(1.04)}
.higer-cat button.hc-btn-gold:disabled{cursor:not-allowed;opacity:.5;filter:grayscale(.5);transform:none;box-shadow:none}
.higer-cat .hc-badge{display:inline-grid;place-items:center;min-width:20px;height:20px;padding:0 6px;border-radius:9999px;background:var(--hc-gold-500);color:var(--hc-navy-900);font-size:11px;font-weight:900;line-height:1}

/* ---------- مسیر صفحه (داخل سربرگ و روی همان پس‌زمینه) و پیام‌ها ---------- */
.higer-cat .hc-crumbs{margin-bottom:32px;border-bottom:1px solid rgba(243,217,139,.16)}
@media(min-width:1024px){.higer-cat .hc-crumbs{margin-bottom:44px}}
.higer-cat .hc-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:rgba(250,247,239,.74)}
.higer-cat .hc-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-cat .hc-crumbs li+li::before{content:"‹";color:var(--hc-gold-500);font-weight:900}
.higer-cat .hc-crumbs a:hover{color:var(--hc-gold-300)}
.higer-cat .hc-crumbs [aria-current]{color:var(--hc-cream);font-weight:900}
.higer-cat .hc-crumbs-row{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px}
.higer-cat .hc-crumbs-row ol{flex:1;min-width:0}
.higer-cat a.hc-back-shop{display:inline-flex;flex:none;align-items:center;gap:6px;padding:5px 12px;border:1px solid rgba(243,217,139,.26);border-radius:9999px;background:rgba(7,15,29,.35);color:var(--hc-gold-300);font-size:11px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s,color .2s}
.higer-cat a.hc-back-shop:hover{border-color:var(--hc-gold-400);background:rgba(217,161,59,.2);color:#fff}
@media(max-width:639px){.higer-cat a.hc-back-shop{margin-bottom:10px}}
.higer-cat .hc-notices{padding-block:16px 8px}
.higer-cat .hc-notices :is(.woocommerce-message,.woocommerce-info,.woocommerce-error){display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin:0 0 8px;padding:14px 18px;border:1px solid var(--hc-line);border-radius:16px;background:#fff;font-size:13px;font-weight:700;box-shadow:0 10px 24px rgba(16,36,62,.06)}

/* ---------- سربرگ فروشگاه و نوار دسته‌بندی سریع ---------- */
.higer-cat .hc-hero{position:relative;overflow:hidden;padding-block:0 24px;background:radial-gradient(960px 440px at 85% -10%,rgba(217,161,59,.18),transparent 60%),radial-gradient(800px 420px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 48%,#16304f 100%);color:var(--hc-cream)}
@media(min-width:1024px){.higer-cat .hc-hero{padding-block:0 28px}}
.higer-cat .hc-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-cat .hc-hero>*{position:relative}
.higer-cat .hc-hero-grid{display:grid;gap:20px;align-items:center}
@media(min-width:1024px){.higer-cat .hc-hero-grid{grid-template-columns:minmax(0,1.5fr) minmax(0,320px)}}
.higer-cat .hc-hero-title{margin-top:12px;font-size:26px;line-height:1.4;color:#fff}
@media(min-width:640px){.higer-cat .hc-hero-title{font-size:34px}}
.higer-cat .hc-hero-sub{margin-top:8px;max-width:680px;font-size:13px;line-height:2;color:rgba(248,234,208,.85)}
.higer-cat a.hc-hero-finder{position:relative;display:flex;align-items:center;gap:12px;max-width:520px;margin-top:18px;padding:12px 14px;border:1.5px solid rgba(217,161,59,.6);border-radius:20px;background:radial-gradient(320px 130px at 92% 0%,rgba(217,161,59,.26),transparent 70%),linear-gradient(155deg,rgba(16,36,62,.9),rgba(24,50,80,.9));color:var(--hc-cream);box-shadow:0 14px 32px rgba(7,15,29,.35);transition:transform .22s,border-color .22s}
.higer-cat a.hc-hero-finder:hover{transform:translateY(-2px);border-color:var(--hc-gold-400);color:var(--hc-cream)}
.higer-cat .hc-hero-finder .hc-finder-ico{position:relative}
.higer-cat .hc-hero-finder .hc-finder-ico::after{content:"";position:absolute;top:-3px;right:-3px;width:9px;height:9px;border:2px solid #0b1a30;border-radius:50%;background:var(--hc-gold-300);animation:hc-finder-pulse 2.2s infinite}
@keyframes hc-finder-pulse{0%,100%{box-shadow:0 0 0 0 rgba(243,217,139,.75)}65%{box-shadow:0 0 0 7px rgba(243,217,139,0)}}
.higer-cat .hc-hero-finder .hc-finder-copy{flex:1;min-width:0}
.higer-cat .hc-hero-finder .hc-finder-copy b{display:block;font-size:13px;font-weight:900;color:var(--hc-gold-300)}
.higer-cat .hc-hero-finder .hc-finder-copy small{display:block;margin-top:2px;font-size:11px;font-weight:700;line-height:1.7;color:rgba(250,247,239,.85)}
.higer-cat .hc-hero-finder .hc-finder-go{display:inline-flex;flex:none;align-items:center;gap:3px;padding:6px 11px;border-radius:9999px;border:1px solid rgba(243,217,139,.45);background:rgba(217,161,59,.2);font-size:11px;font-weight:900;color:var(--hc-gold-300);transition:background .2s,color .2s}
.higer-cat .hc-hero-finder:hover .hc-finder-go{background:var(--hc-gold-500);border-color:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat .hc-hero-art{display:none}
@media(min-width:1024px){.higer-cat .hc-hero-art{display:flex;align-items:center;justify-content:center;padding:12px 18px;border:1px solid rgba(243,217,139,.2);border-radius:22px;background:rgba(7,15,29,.42);backdrop-filter:blur(8px)}}
.higer-cat .hc-hero-art .hc-core-svg{width:100%;max-width:260px;height:auto}
.higer-cat .hc-cat-strip-wrap{margin-top:22px}
.higer-cat .hc-cat-strip{display:flex;gap:8px;padding-bottom:4px;overflow-x:auto;scrollbar-width:none}
.higer-cat .hc-cat-strip::-webkit-scrollbar{display:none}
.higer-cat button.hc-cat-pill{display:inline-flex;flex:none;align-items:center;gap:8px;padding:8px 14px;border:1px solid rgba(243,217,139,.22);border-radius:9999px;background:rgba(7,15,29,.45);color:var(--hc-cream);font-size:12px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s,color .2s}
.higer-cat button.hc-cat-pill.is-sub{font-size:11px;opacity:.92}
.higer-cat button.hc-cat-pill:hover{border-color:rgba(243,217,139,.6);background:rgba(24,50,80,.75)}
.higer-cat button.hc-cat-pill[aria-pressed="true"]{border-color:var(--hc-gold-500);background:linear-gradient(180deg,#ecc470 0%,#d9a13b 60%,#c8892a 100%);color:var(--hc-navy-900);box-shadow:0 8px 20px rgba(217,161,59,.32)}
.higer-cat .hc-cat-pill span{display:inline-grid;place-items:center;min-width:20px;height:20px;padding:0 6px;border-radius:9999px;background:rgba(255,255,255,.12);font-size:10px;font-weight:900}
.higer-cat button.hc-cat-pill[aria-pressed="true"] span{background:rgba(16,36,62,.16);color:var(--hc-navy-900)}
.higer-cat a.hc-cat-pill{display:inline-flex;flex:none;align-items:center;gap:8px;padding:8px 14px;border:1px solid rgba(243,217,139,.22);border-radius:9999px;background:rgba(7,15,29,.45);color:var(--hc-cream);font-size:12px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s,color .2s}
.higer-cat a.hc-cat-pill:hover{border-color:rgba(243,217,139,.65);background:rgba(24,50,80,.78);color:#fff}
.higer-cat a.hc-cat-pill.is-active,.higer-cat a.hc-cat-pill[aria-current="page"]{border-color:var(--hc-gold-500);background:linear-gradient(180deg,#ecc470 0%,#d9a13b 60%,#c8892a 100%);color:var(--hc-navy-900);box-shadow:0 8px 20px rgba(217,161,59,.32)}
.higer-cat a.hc-cat-pill.is-active span,.higer-cat a.hc-cat-pill[aria-current="page"] span{background:rgba(16,36,62,.16);color:var(--hc-navy-900)}
.higer-cat a.hc-cat-pill.is-ghost{background:transparent;border-style:dashed;border-color:rgba(243,217,139,.34);color:var(--hc-gold-300)}
.higer-cat a.hc-cat-pill.is-ghost:hover{background:rgba(217,161,59,.14);border-style:solid;border-color:var(--hc-gold-400);color:#fff}

/* ---------- سربرگ اختصاصی صفحات دسته‌بندی (product_cat) ---------- */
.higer-cat .hc-hero.is-category{padding-block:0 28px;border-bottom:2px solid rgba(217,161,59,.35)}
@media(min-width:1024px){.higer-cat .hc-hero.is-category{padding-block:0 34px}}
.higer-cat .hc-hero.is-category::after{content:"";position:absolute;inset-inline:0;bottom:0;height:1px;background:linear-gradient(90deg,transparent,rgba(243,217,139,.55),transparent);pointer-events:none}
.higer-cat .hc-hero.is-category .hc-crumbs{margin-bottom:26px}
@media(min-width:1024px){.higer-cat .hc-hero.is-category .hc-crumbs{margin-bottom:36px}}
.higer-cat .hc-hero.is-theme-foam{background:radial-gradient(880px 440px at 14% 8%,rgba(98,146,96,.24),transparent 60%),radial-gradient(760px 380px at 88% -12%,rgba(217,161,59,.18),transparent 58%),linear-gradient(155deg,#081726 0%,#0f2737 52%,#143342 100%)}
.higer-cat .hc-hero.is-theme-rebond{background:radial-gradient(880px 440px at 14% 12%,rgba(196,132,54,.24),transparent 58%),radial-gradient(740px 380px at 88% -10%,rgba(231,185,92,.18),transparent 56%),linear-gradient(155deg,#0c1828 0%,#18263a 52%,#223145 100%)}
.higer-cat .hc-hero.is-theme-pocket{background:radial-gradient(860px 460px at 16% 10%,rgba(235,192,102,.24),transparent 58%),radial-gradient(780px 420px at 90% 105%,rgba(52,92,148,.34),transparent 56%),linear-gradient(155deg,#060f1f 0%,#0d203a 50%,#152d4f 100%)}
.higer-cat .hc-hero.is-theme-bonnell{background:radial-gradient(900px 440px at 84% -10%,rgba(217,161,59,.22),transparent 58%),radial-gradient(780px 420px at 8% 100%,rgba(49,92,142,.36),transparent 58%),linear-gradient(155deg,#0a192e 0%,#112744 50%,#18365b 100%)}
.higer-cat .hc-hero.is-theme-accessory{background:radial-gradient(820px 420px at 15% 12%,rgba(243,217,139,.18),transparent 58%),radial-gradient(720px 420px at 88% 100%,rgba(74,118,146,.28),transparent 58%),linear-gradient(155deg,#0d1f30 0%,#162f46 52%,#1e3d56 100%)}
.higer-cat .hc-hero.is-theme-mattress{background:radial-gradient(900px 440px at 18% 0%,rgba(217,161,59,.22),transparent 58%),radial-gradient(780px 420px at 88% 105%,rgba(43,78,119,.36),transparent 58%),linear-gradient(155deg,#081526 0%,#10243e 48%,#183556 100%)}
.higer-cat .hc-hero.is-category .hc-hero-grid{gap:24px}
@media(min-width:1024px){.higer-cat .hc-hero.is-category .hc-hero-grid{grid-template-columns:minmax(0,1.45fr) minmax(0,360px);gap:36px}}
.higer-cat .hc-hero.is-category .hc-hero-title{font-size:28px;line-height:1.38}
@media(min-width:640px){.higer-cat .hc-hero.is-category .hc-hero-title{font-size:38px}}
.higer-cat .hc-hero.is-category .hc-hero-sub{margin-top:10px;max-width:660px;font-size:13.5px;line-height:2.05;color:rgba(250,247,239,.86)}
.higer-cat .hc-cat-traits{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px}
.higer-cat .hc-cat-traits li{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border:1px solid rgba(243,217,139,.24);border-radius:9999px;background:rgba(7,15,29,.36);font-size:11.5px;font-weight:700;color:var(--hc-gold-200)}
.higer-cat .hc-cat-traits li .hc-i{color:var(--hc-gold-400)}
.higer-cat .hc-cat-stats{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1px;margin-top:20px;max-width:640px;overflow:hidden;border:1px solid rgba(243,217,139,.2);border-radius:16px;background:rgba(243,217,139,.14)}
@media(min-width:640px){.higer-cat .hc-cat-stats{grid-template-columns:repeat(auto-fit,minmax(120px,1fr))}}
.higer-cat .hc-cat-stat{padding:11px 14px;background:rgba(7,15,29,.52);backdrop-filter:blur(6px)}
.higer-cat .hc-cat-stat small{display:block;font-size:10px;font-weight:700;color:rgba(248,234,208,.68)}
.higer-cat .hc-cat-stat b{display:block;margin-top:2px;font-size:13px;font-weight:900;color:#fff;line-height:1.5}
.higer-cat .hc-hero-art.is-cat{display:none;flex-direction:column;align-items:stretch;justify-content:flex-start;gap:12px;padding:18px;border:1px solid rgba(243,217,139,.28);border-radius:24px;background:radial-gradient(280px 180px at 50% 0%,rgba(243,217,139,.12),transparent 75%),rgba(7,15,29,.5);box-shadow:0 24px 52px rgba(4,10,20,.38);backdrop-filter:blur(10px)}
@media(min-width:1024px){.higer-cat .hc-hero-art.is-cat{display:flex}}
.higer-cat .hc-hero-art.is-cat .hc-cat-art-stage{display:flex;align-items:center;justify-content:center;width:100%;aspect-ratio:16/10;overflow:hidden;border-radius:16px;border:1px solid rgba(243,217,139,.14);background:rgba(7,15,29,.42);padding:12px}
.higer-cat .hc-hero-art.is-cat .hc-cat-art-stage.has-img{padding:0}
.higer-cat .hc-hero-art.is-cat .hc-cat-art-stage img{width:100%;height:100%;object-fit:cover}
.higer-cat .hc-hero-art.is-cat .hc-core-svg{width:100%;max-width:290px;height:auto}
.higer-cat .hc-cat-art-cap{display:flex;align-items:center;justify-content:space-between;gap:8px;font-size:11px;font-weight:800;color:var(--hc-gold-300)}
.higer-cat a.hc-cat-finder-mini{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:9px 12px;border:1px solid rgba(217,161,59,.42);border-radius:14px;background:rgba(217,161,59,.14);color:var(--hc-gold-200);font-size:11px;font-weight:800;line-height:1.6;transition:background .2s,border-color .2s,color .2s}
.higer-cat a.hc-cat-finder-mini:hover{background:var(--hc-gold-500);border-color:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat a.hc-cat-finder-mini>span{display:inline-flex;align-items:center;gap:6px;min-width:0}
.higer-cat .hc-cat-strip-label{display:inline-flex;flex:none;align-items:center;font-size:11px;font-weight:800;color:rgba(248,234,208,.72);padding-inline-end:4px;white-space:nowrap}
.higer-cat .hc-cat-nav-row{display:flex;align-items:center;gap:8px;padding-top:16px;margin-top:22px;border-top:1px solid rgba(243,217,139,.14);overflow-x:auto;scrollbar-width:none}
.higer-cat .hc-cat-nav-row::-webkit-scrollbar{display:none}
.higer-cat a.hc-cat-row{display:flex;align-items:center;gap:8px;width:100%;padding:7px 8px;border-radius:10px;font-size:12px;font-weight:700;color:var(--hc-navy-800);transition:background .15s,color .15s}
.higer-cat a.hc-cat-row:hover{background:var(--hc-cream);color:var(--hc-navy-900)}
.higer-cat a.hc-cat-row[aria-current="page"]{background:#fdf3d8;font-weight:900;color:var(--hc-navy-900)}
.higer-cat a.hc-cat-row[aria-current="page"] .hc-radio{border-color:var(--hc-gold-600);background:var(--hc-gold-500);box-shadow:inset 0 0 0 3px #fff}
.higer-cat a.hc-cat-all-link{display:flex;align-items:center;justify-content:space-between;gap:6px;margin-top:10px;padding:8px 10px;border-top:1px dashed var(--hc-line);font-size:11px;font-weight:800;color:var(--hc-gold-600)}
.higer-cat a.hc-cat-all-link:hover{color:var(--hc-navy-900)}
.higer-cat .hc-cat-guide-sec{padding:0 0 48px;background:var(--hc-paper)}
.higer-cat .hc-cat-guide{padding:24px;border:1px solid var(--hc-line);border-radius:24px;background:#fff;box-shadow:0 12px 30px rgba(16,36,62,.05)}
@media(min-width:640px){.higer-cat .hc-cat-guide{padding:32px 36px}}
.higer-cat .hc-cat-guide h2.hc-cat-guide-title{margin:10px 0 0;font-size:20px;font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-cat-guide-body{position:relative;margin-top:14px;font-size:14px;line-height:2.1;color:var(--hc-navy-700)}
.higer-cat .hc-cat-guide-body :is(p,ul,ol){margin:0 0 12px}
.higer-cat .hc-cat-guide-body ul{padding-inline-start:22px;list-style:disc}
.higer-cat .hc-cat-guide-body ol{padding-inline-start:22px;list-style:decimal}
.higer-cat .hc-cat-guide-body :is(h2,h3){margin:20px 0 8px;font-size:17px;font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-cat-guide-body a{color:var(--hc-gold-600);text-decoration:underline;text-underline-offset:3px}
.higer-cat .hc-cat-guide-body.is-clamped{max-height:220px;overflow:hidden}
.higer-cat .hc-cat-guide-body.is-clamped::after{content:"";position:absolute;inset-inline:0;bottom:0;height:84px;background:linear-gradient(to bottom,rgba(255,255,255,0),#fff 90%);pointer-events:none}
.higer-cat button.hc-cat-guide-btn{display:inline-flex;align-items:center;gap:6px;margin-top:14px;padding:9px 18px;border:1.5px solid var(--hc-line);border-radius:9999px;background:var(--hc-cream);font-size:12px;font-weight:900;color:var(--hc-navy-900);transition:border-color .2s,background .2s}
.higer-cat button.hc-cat-guide-btn:hover{border-color:var(--hc-gold-500);background:#fdf3d8}
.higer-cat button.hc-cat-guide-btn[aria-expanded="true"] .hc-i{transform:rotate(180deg)}
.higer-cat button.hc-cat-guide-btn .hc-i{transition:transform .2s}
.higer-cat-archive-main{display:block;width:100%;margin:0;padding:0;overflow-x:clip}

/* ---------- نوار ابزار موبایل ---------- */
.higer-cat .hc-mobile-bar{position:sticky;top:var(--hc-sticky-top,var(--wp-admin--admin-bar--height,0px));z-index:38;border-bottom:1px solid var(--hc-line);background:rgba(250,247,239,.96);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:top .15s ease}
@media(min-width:1024px){.higer-cat .hc-mobile-bar{display:none}}
.higer-cat .hc-mobile-bar-inner{display:flex;align-items:center;gap:10px;padding-block:10px}
.higer-cat button.hc-mobile-filter-btn{display:inline-flex;flex:none;align-items:center;gap:8px;padding:9px 14px;border:1.5px solid var(--hc-navy-900);border-radius:9999px;background:var(--hc-navy-900);color:var(--hc-gold-300);font-size:12px;font-weight:900}
.higer-cat .hc-mobile-sort{flex:1;min-width:0}
.higer-cat .hc-mobile-sort select{width:100%;height:40px;padding:0 12px;border:1.5px solid var(--hc-line);border-radius:9999px;background:#fff;font:inherit;font-size:12px;font-weight:800;color:var(--hc-navy-900)}

/* ---------- چیدمان دو ستونه اصلی ---------- */
.higer-cat .hc-main{padding-block:28px 64px;background-color:var(--hc-paper);background-image:radial-gradient(ellipse 80% 50% at 80% 0%,rgba(217,161,59,.1),transparent),radial-gradient(ellipse 60% 50% at 0% 100%,rgba(16,36,62,.06),transparent)}
@media(min-width:1024px){.higer-cat .hc-main{padding-block:36px 84px}}
.higer-cat .hc-layout{display:grid;gap:28px;align-items:start}
@media(min-width:1024px){.higer-cat .hc-layout{grid-template-columns:310px minmax(0,1fr)}}

/* ---------- سایدبار فیلترها (دسکتاپ چسبنده + موبایل دراور) ---------- */
.higer-cat .hc-backdrop{position:fixed;inset:0;z-index:9990;background:rgba(7,15,29,.62);backdrop-filter:blur(3px)}
.higer-cat .hc-sidebar{border:1px solid var(--hc-line);border-radius:24px;background:#fff;box-shadow:0 18px 44px rgba(16,36,62,.08)}
@media(min-width:1024px){
  .higer-cat .hc-sidebar{position:sticky;top:calc(var(--hc-sticky-top,var(--wp-admin--admin-bar--height,0px)) + 16px);max-height:calc(100vh - var(--hc-sticky-top,0px) - 32px);display:flex;flex-direction:column;overflow:hidden}
  .higer-cat .hc-sidebar-body{overflow-y:auto;scrollbar-width:thin}
  .higer-cat .hc-drawer-close,.higer-cat .hc-sidebar-foot{display:none!important}
}
@media(max-width:1023px){
  .higer-cat .hc-sidebar{position:fixed;top:var(--hc-drawer-top,var(--hc-sticky-top,var(--wp-admin--admin-bar--height,0px)));right:0;bottom:0;z-index:9995;display:flex;flex-direction:column;overflow:hidden;width:min(90vw,380px);border-radius:24px 0 0 24px;box-shadow:-20px 0 50px rgba(7,15,29,.45);transform:translateX(105%);visibility:hidden;transition:transform .28s cubic-bezier(.22,1,.36,1),visibility .28s,top .15s ease}
  .higer-cat .hc-sidebar.is-open{transform:none;visibility:visible}
  .higer-cat .hc-sidebar-body{flex:1;min-height:0;overflow-y:auto;-webkit-overflow-scrolling:touch}
}
.higer-cat .hc-sidebar-head{display:flex;flex-direction:column;gap:10px;padding:14px 16px;border-bottom:1px solid var(--hc-line);background:var(--hc-cream);position:sticky;top:0;z-index:6}
.higer-cat .hc-sidebar-title{display:flex;align-items:center;gap:8px;color:var(--hc-navy-900)}
.higer-cat .hc-sidebar-title h2{flex:1;font-size:15px;font-weight:900}
.higer-cat button.hc-reset-link{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:800;color:var(--hc-bad)}
.higer-cat button.hc-reset-link:hover{text-decoration:underline}
.higer-cat button.hc-drawer-close{display:grid;place-items:center;width:34px;height:34px;border-radius:50%;background:#fff;border:1px solid var(--hc-line);color:var(--hc-navy-900)}
.higer-cat .hc-sidebar-foot{padding:12px 16px;border-top:1px solid var(--hc-line);background:var(--hc-cream)}
.higer-cat .hc-drawer-apply{width:100%}

/* گروه‌های فیلتر */
.higer-cat .hc-fgroup{border-bottom:1px solid var(--hc-line)}
.higer-cat .hc-fgroup:last-of-type{border-bottom:0}
.higer-cat .hc-fgroup-plain{padding:16px 18px}
.higer-cat .hc-fgroup{border-bottom:0;margin:10px 12px;border:1px solid var(--hc-line);border-radius:16px;background:#fffdf6;overflow:hidden}
.higer-cat .hc-fgroup:first-of-type{margin-top:12px}
.higer-cat .hc-fgroup>summary{position:relative;display:flex;align-items:center;justify-content:space-between;gap:8px;padding:11px 14px;font-size:13px;font-weight:900;color:var(--hc-navy-900);list-style:none;cursor:pointer;user-select:none;background:linear-gradient(270deg,rgba(217,161,59,.14),rgba(255,253,246,.4));border-right:3px solid var(--hc-gold-500);transition:background .2s}
.higer-cat .hc-fgroup>summary::-webkit-details-marker{display:none}
.higer-cat .hc-fgroup[open]>summary{background:linear-gradient(270deg,rgba(217,161,59,.2),rgba(255,253,246,.6));border-right-color:var(--hc-gold-600)}
.higer-cat .hc-fgroup>summary:hover{background:linear-gradient(270deg,rgba(217,161,59,.24),rgba(255,253,246,.8))}
.higer-cat .hc-fgroup>summary>span{display:inline-flex;align-items:center;gap:7px}
.higer-cat .hc-fgroup>summary>span .hc-i{color:var(--hc-navy-900);background:var(--hc-gold-500);border-radius:8px;padding:3px}
.higer-cat .hc-fgroup>summary>.hc-i{color:var(--hc-navy-600);transition:transform .2s}
.higer-cat .hc-fgroup[open]>summary>.hc-i{transform:rotate(180deg)}
.higer-cat .hc-fhint{font-size:10px;font-weight:700;color:var(--hc-gold-600)}
.higer-cat .hc-fbody{padding:0 18px 16px}

/* جستجو و سوییچ‌ها */
.higer-cat .hc-search{display:flex;align-items:center;gap:8px;padding:0 12px;border:1.5px solid var(--hc-line);border-radius:14px;background:var(--hc-cream);transition:border-color .2s,background .2s}
.higer-cat .hc-search:focus-within{border-color:var(--hc-gold-500);background:#fff}
.higer-cat .hc-search>.hc-i{color:var(--hc-navy-600)}
.higer-cat .hc-search input[type="search"]{flex:1;min-width:0;height:40px;border:0;background:transparent;font:inherit;font-size:12px;font-weight:700;color:var(--hc-navy-900);outline:none}
.higer-cat .hc-search input[type="search"]::-webkit-search-cancel-button{display:none}
.higer-cat button.hc-search-clear{display:grid;place-items:center;width:24px;height:24px;border-radius:50%;background:rgba(16,36,62,.08);color:var(--hc-navy-800)}
.higer-cat .hc-toggles{display:grid;gap:10px;margin-top:14px}
.higer-cat .hc-switch{display:flex;align-items:center;gap:10px;font-size:12px;font-weight:800;color:var(--hc-navy-800);cursor:pointer}
.higer-cat .hc-switch input{position:absolute;opacity:0;pointer-events:none}
.higer-cat .hc-switch-ui{position:relative;flex:none;width:38px;height:22px;border-radius:9999px;background:#d8d2c1;transition:background .2s}
.higer-cat .hc-switch-ui::after{content:"";position:absolute;top:3px;right:3px;width:16px;height:16px;border-radius:50%;background:#fff;box-shadow:0 2px 5px rgba(0,0,0,.2);transition:transform .2s}
.higer-cat .hc-switch input:checked+.hc-switch-ui{background:var(--hc-gold-500)}
.higer-cat .hc-switch input:checked+.hc-switch-ui::after{transform:translateX(-16px)}
.higer-cat .hc-switch input:focus-visible+.hc-switch-ui{outline:2px solid var(--hc-navy-900);outline-offset:2px}

/* گرید انتخاب سایز در فیلتر */
.higer-cat .hc-size-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:6px}
.higer-cat button.hc-size-chip{position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:56px;padding:6px 4px;border:1.5px solid var(--hc-line);border-radius:12px;background:#fffdf6;text-align:center;transition:border-color .2s,background .2s,transform .15s}
.higer-cat button.hc-size-chip:hover{border-color:rgba(217,161,59,.7);transform:translateY(-1px)}
.higer-cat button.hc-size-chip[aria-pressed="true"]{border-color:var(--hc-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);box-shadow:0 8px 18px rgba(217,161,59,.24),inset 0 0 0 1px rgba(217,161,59,.4)}
.higer-cat button.hc-size-chip.is-zero:not([aria-pressed="true"]){opacity:.38}
.higer-cat .hc-size-chip b{font-size:12px;font-weight:900;line-height:1.4;color:var(--hc-navy-900)}
.higer-cat .hc-size-chip small{font-size:9px;font-weight:700;color:var(--hc-navy-600)}
.higer-cat .hc-size-chip em{font-size:9px;font-style:normal;font-weight:800;color:var(--hc-gold-600)}

/* اسلایدر دوطرفه قیمت */
.higer-cat .hc-price-readout{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:8px 10px;border:1px solid var(--hc-line);border-radius:12px;background:var(--hc-cream);font-size:11px;font-weight:700;color:var(--hc-navy-700)}
.higer-cat .hc-price-readout b{font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-range-dual{position:relative;height:30px;margin-top:12px;direction:rtl}
.higer-cat .hc-range-track{position:absolute;top:50%;left:0;right:0;height:6px;transform:translateY(-50%);border-radius:9999px;background:var(--hc-line);overflow:hidden}
.higer-cat .hc-range-track span{position:absolute;top:0;bottom:0;background:linear-gradient(270deg,#ecc470,#c8892a);border-radius:9999px}
.higer-cat .hc-range-dual input[type="range"]{position:absolute;top:0;left:0;width:100%;height:30px;margin:0;background:none;pointer-events:none;-webkit-appearance:none;appearance:none}
.higer-cat .hc-range-dual input[type="range"]::-webkit-slider-thumb{width:20px;height:20px;border:2.5px solid var(--hc-navy-900);border-radius:50%;background:var(--hc-gold-400);box-shadow:0 3px 8px rgba(16,36,62,.3);pointer-events:auto;cursor:pointer;-webkit-appearance:none;appearance:none}
.higer-cat .hc-range-dual input[type="range"]::-moz-range-thumb{width:18px;height:18px;border:2.5px solid var(--hc-navy-900);border-radius:50%;background:var(--hc-gold-400);box-shadow:0 3px 8px rgba(16,36,62,.3);pointer-events:auto;cursor:pointer}
.higer-cat button.hc-price-reset{display:none;align-items:center;gap:5px;margin-top:10px;padding:6px 11px;border:1px solid var(--hc-line);border-radius:10px;background:#fff;font-size:10px;font-weight:800;color:var(--hc-navy-700)}
.higer-cat button.hc-price-reset:hover{border-color:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat button.hc-price-reset.is-visible{display:inline-flex}
.higer-cat .hc-presets{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:6px;margin-top:10px}
.higer-cat button.hc-preset{padding:6px 8px;border:1px solid var(--hc-line);border-radius:10px;background:#fffdf6;font-size:10px;font-weight:800;color:var(--hc-navy-700);text-align:center;transition:border-color .2s,background .2s}
.higer-cat button.hc-preset:hover{border-color:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat button.hc-preset.is-on{border-color:var(--hc-gold-500);background:#fdf3d8;color:var(--hc-navy-900)}

/* درخت دسته‌بندی و چک‌لیست ویژگی‌ها */
.higer-cat .hc-cat-tree,.higer-cat .hc-check-list{display:grid;gap:4px}
.higer-cat .hc-cat-tree li{padding-right:calc(var(--depth,0) * 14px)}
.higer-cat button.hc-cat-row,.higer-cat button.hc-check-row{display:flex;align-items:center;gap:9px;width:100%;padding:8px 10px;border:1px solid transparent;border-radius:12px;font-size:12px;font-weight:800;color:var(--hc-navy-800);transition:background .15s,border-color .15s}
.higer-cat button.hc-cat-row:hover,.higer-cat button.hc-check-row:hover{background:var(--hc-cream)}
.higer-cat button.hc-cat-row[aria-pressed="true"],.higer-cat button.hc-check-row[aria-pressed="true"]{border-color:rgba(217,161,59,.55);background:linear-gradient(160deg,#fffdf3,#fdf3d8);color:var(--hc-navy-900)}
.higer-cat button.hc-cat-row.is-zero:not([aria-pressed="true"]),.higer-cat button.hc-check-row.is-zero:not([aria-pressed="true"]),.higer-cat button.hc-fpill.is-zero:not([aria-pressed="true"]){opacity:.38}
.higer-cat .hc-radio{display:grid;flex:none;place-items:center;width:16px;height:16px;border:1.5px solid #bfb8a5;border-radius:50%;background:#fff}
.higer-cat button.hc-cat-row[aria-pressed="true"] .hc-radio{border-color:var(--hc-navy-900);background:var(--hc-navy-900);box-shadow:inset 0 0 0 3px var(--hc-gold-400)}
.higer-cat .hc-box{display:grid;flex:none;place-items:center;width:18px;height:18px;border:1.5px solid #bfb8a5;border-radius:6px;background:#fff;color:transparent;transition:background .15s,border-color .15s,color .15s}
.higer-cat button.hc-check-row[aria-pressed="true"] .hc-box{border-color:var(--hc-navy-900);background:var(--hc-navy-900);color:var(--hc-gold-300)}
.higer-cat .hc-cat-name,.higer-cat .hc-check-label{display:flex;flex:1;align-items:center;justify-content:space-between;gap:6px;min-width:0}
.higer-cat .hc-fcount{flex:none;font-size:11px;font-style:normal;font-weight:800;color:var(--hc-navy-600)}
.higer-cat .hc-pill-list{display:flex;flex-wrap:wrap;gap:6px}
.higer-cat button.hc-fpill{display:inline-flex;align-items:center;gap:5px;padding:7px 12px;border:1.5px solid var(--hc-line);border-radius:9999px;background:#fffdf6;font-size:12px;font-weight:800;color:var(--hc-navy-800);transition:border-color .2s,background .2s}
.higer-cat button.hc-fpill:hover{border-color:rgba(217,161,59,.7)}
.higer-cat button.hc-fpill[aria-pressed="true"]{border-color:var(--hc-gold-500);background:#fdf3d8;color:var(--hc-navy-900)}
.higer-cat .hc-fpill em{font-size:10px;font-style:normal;font-weight:800;color:var(--hc-gold-600)}
.higer-cat .hc-mini-meter{display:inline-flex;gap:3px;vertical-align:middle}
.higer-cat .hc-mini-meter i{width:11px;height:4px;border-radius:9999px;background:var(--hc-line)}
.higer-cat .hc-mini-meter i.is-on{background:var(--hc-gold-500)}

/* کارت تشک‌سنج در سایدبار و هیرو */
.higer-cat a.hc-finder-cta{display:flex;align-items:center;gap:10px;margin:12px;padding:12px;border:1.5px solid rgba(217,161,59,.55);border-radius:18px;background:radial-gradient(240px 100px at 90% 0%,rgba(217,161,59,.22),transparent 70%),linear-gradient(155deg,#0b1a30 0%,#10243e 55%,#183250 100%);color:var(--hc-cream);box-shadow:0 12px 26px rgba(16,36,62,.18);transition:transform .2s,border-color .2s}
.higer-cat a.hc-finder-cta:hover{transform:translateY(-2px);border-color:var(--hc-gold-400);color:var(--hc-cream)}
.higer-cat .hc-finder-ico{position:relative;display:grid;flex:none;place-items:center;width:40px;height:40px;border-radius:12px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 65%,#c8892a 100%);color:var(--hc-navy-900)}
.higer-cat .hc-finder-copy{flex:1;min-width:0}
.higer-cat .hc-finder-copy b{display:block;font-size:12px;font-weight:900;color:var(--hc-gold-300)}
.higer-cat .hc-finder-copy small{display:block;margin-top:2px;font-size:10px;font-weight:700;line-height:1.6;color:rgba(250,247,239,.82)}
.higer-cat .hc-finder-go{display:inline-flex;flex:none;align-items:center;gap:2px;font-size:11px;font-weight:900;color:var(--hc-gold-300)}

/* ---------- نوار ابزار بالا و چیپ‌های فیلتر فعال ---------- */
.higer-cat .hc-content{min-width:0}
.higer-cat .hc-toolbar{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px;padding:12px 16px;border:1px solid var(--hc-line);border-radius:18px;background:#fff;box-shadow:0 8px 22px rgba(16,36,62,.05)}
.higer-cat .hc-result-meta{display:flex;flex-wrap:wrap;align-items:center;gap:8px;font-size:13px;font-weight:700;color:var(--hc-navy-700)}
.higer-cat .hc-result-meta b{font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-size-banner{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:9999px;background:#fdf3d8;border:1px solid rgba(217,161,59,.5);font-size:11px;font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-toolbar-end{display:none;align-items:center;gap:10px}
@media(min-width:1024px){.higer-cat .hc-toolbar-end{display:flex}}
.higer-cat .hc-sort-box{display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:800;color:var(--hc-navy-700)}
.higer-cat .hc-sort-box select{height:38px;padding:0 12px;border:1.5px solid var(--hc-line);border-radius:9999px;background:var(--hc-cream);font:inherit;font-size:12px;font-weight:800;color:var(--hc-navy-900)}
.higer-cat .hc-view-switch{display:inline-flex;padding:3px;border:1px solid var(--hc-line);border-radius:12px;background:var(--hc-cream)}
.higer-cat .hc-view-switch button{display:grid;place-items:center;width:32px;height:32px;border-radius:9px;color:var(--hc-navy-600)}
.higer-cat .hc-view-switch button[aria-pressed="true"]{background:var(--hc-navy-900);color:var(--hc-gold-300)}

/* نوار فیلترهای فعال بالای محصولات — چسبنده فقط در تبلت و دسکتاپ (≥۷۶۸px) */
.higer-cat .hc-active-bar{position:relative;z-index:35;margin-bottom:16px;padding:10px 12px;border:1px dashed rgba(217,161,59,.6);border-radius:16px;background:rgba(255,253,246,.96);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);box-shadow:0 10px 26px rgba(16,36,62,.08)}
@media(min-width:768px){
  .higer-cat .hc-active-bar{position:sticky;top:calc(var(--hc-sticky-top,var(--wp-admin--admin-bar--height,0px)) + var(--hc-mbar-h,61px) + 10px);transition:top .15s ease}
}
@media(min-width:1024px){
  .higer-cat .hc-active-bar{top:calc(var(--hc-sticky-top,var(--wp-admin--admin-bar--height,0px)) + 16px)}
}

/* فیلترهای فعال داخل سایدبار — فقط موبایل (<۷۶۸px) و چسبنده بالای دراور */
@media(min-width:768px){
  .higer-cat .hc-sidebar-head .hc-active-chips,
  .higer-cat .hc-sidebar-head .hc-reset-link,
  .higer-cat .hc-sidebar-head .hc-reset-link.is-visible{display:none!important}
}
@media(max-width:767px){
  .higer-cat .hc-sidebar-head{flex:none;position:sticky;top:0;z-index:6;box-shadow:0 8px 18px rgba(16,36,62,.06)}
  .higer-cat .hc-sidebar-head .hc-active-chips{max-height:92px;overflow-y:auto;scrollbar-width:thin;overscroll-behavior:contain}
  .higer-cat .hc-sidebar-head .hc-active-chips:empty{display:none}
  .higer-cat .hc-sidebar-head .hc-reset-link.is-visible{margin-top:0;align-self:flex-start}
}
.higer-cat .hc-active-bar-inner{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:8px}
.higer-cat .hc-active-chips{display:flex;flex-wrap:wrap;gap:6px}
.higer-cat button.hc-chip{display:inline-flex;align-items:center;gap:6px;padding:5px 11px;border:1px solid rgba(217,161,59,.55);border-radius:9999px;background:#fdf3d8;font-size:11px;font-weight:800;color:var(--hc-navy-900);transition:background .15s}
.higer-cat button.hc-chip:hover{background:var(--hc-gold-400)}
.higer-cat button.hc-clear-all{flex:none;font-size:11px;font-weight:900;color:var(--hc-bad)}
.higer-cat button.hc-clear-all:hover{text-decoration:underline}
.higer-cat button.hc-reset-link{display:none;align-items:center;gap:5px;margin-top:10px;padding:7px 12px;border-radius:12px;background:#fff;border:1px solid #fca5a5;font-size:11px;font-weight:800;color:var(--hc-bad)}
.higer-cat button.hc-reset-link:hover{background:#fef2f2}
.higer-cat button.hc-reset-link.is-visible{display:inline-flex}

/* ---------- شبکه و کارت محصولات ---------- */
.higer-cat .hc-grid{display:grid;grid-template-columns:minmax(0,1fr);gap:16px}
@media(min-width:560px){.higer-cat .hc-grid[data-view="grid"]{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(min-width:1180px){.higer-cat .hc-grid[data-view="grid"]{grid-template-columns:repeat(3,minmax(0,1fr));gap:20px}}
.higer-cat .hc-card{display:flex;flex-direction:column;overflow:hidden;border:1px solid var(--hc-line);border-radius:22px;background:#fff;box-shadow:0 12px 30px rgba(16,36,62,.06);transition:transform .25s,box-shadow .25s,border-color .25s}
.higer-cat .hc-card:hover{transform:translateY(-4px);border-color:rgba(217,161,59,.6);box-shadow:0 22px 46px rgba(16,36,62,.14)}
.higer-cat .hc-card.is-out{opacity:.78}
.higer-cat .hc-card-media{position:relative;aspect-ratio:4/3;overflow:hidden;background:radial-gradient(400px 200px at 85% 0%,rgba(217,161,59,.18),transparent 65%),linear-gradient(160deg,#0b1a30 0%,#10243e 55%,#16304f 100%)}
.higer-cat .hc-card-img-link{display:block;width:100%;height:100%}
.higer-cat .hc-card-media img{width:100%;height:100%;object-fit:cover;transition:transform .45s ease}
.higer-cat .hc-card:hover .hc-card-media img{transform:scale(1.04)}
.higer-cat .hc-card-svg-wrap{display:flex;align-items:center;justify-content:center;width:100%;height:100%;padding:24px}
.higer-cat .hc-card-svg-wrap .hc-core-svg{width:100%;max-width:240px;height:auto}
.higer-cat .hc-card-badges{position:absolute;top:12px;right:12px;z-index:2;display:flex;flex-wrap:wrap;gap:5px;max-width:calc(100% - 96px)}
.higer-cat .hc-pill-cat,.higer-cat .hc-pill-war,.higer-cat .hc-pill-out,.higer-cat .hc-pill-sale{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:9999px;font-size:10px;font-weight:800;backdrop-filter:blur(8px)}
.higer-cat .hc-pill-cat{background:rgba(7,15,29,.72);border:1px solid rgba(243,217,139,.35);color:var(--hc-gold-300)}
.higer-cat .hc-pill-war{background:rgba(255,253,246,.92);color:var(--hc-navy-900)}
.higer-cat .hc-pill-out{background:#fee2e2;color:var(--hc-bad)}
.higer-cat .hc-pill-sale{background:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat button.hc-card-cmp-ico{position:absolute;top:12px;left:12px;z-index:2;display:inline-flex;align-items:center;padding:5px 10px;border:1px solid rgba(255,255,255,.32);border-radius:9999px;background:rgba(7,15,29,.66);color:#fff;font-size:10px;font-weight:800;backdrop-filter:blur(8px);transition:background .2s,color .2s,border-color .2s}
.higer-cat button.hc-card-cmp-ico:hover{border-color:var(--hc-gold-400);color:var(--hc-gold-300)}
.higer-cat button.hc-card-cmp-ico[aria-pressed="true"]{border-color:var(--hc-gold-500);background:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat [data-hc-cmp] :is(.hc-cmp-off,.hc-cmp-on){display:inline-flex;align-items:center;gap:4px}
.higer-cat [data-hc-cmp] .hc-cmp-on{display:none}
.higer-cat [data-hc-cmp][aria-pressed="true"] .hc-cmp-on{display:inline-flex}
.higer-cat [data-hc-cmp][aria-pressed="true"] .hc-cmp-off{display:none}

.higer-cat .hc-card-body{display:flex;flex:1;flex-direction:column;gap:12px;padding:16px}
.higer-cat .hc-card-head{display:flex;flex-direction:column;gap:4px;padding-bottom:12px;border-bottom:1px solid var(--hc-line)}
.higer-cat .hc-card-head h2.hc-card-title{margin:0;padding:0;font-size:19px;font-weight:900;line-height:1.45;letter-spacing:-.15px;color:var(--hc-navy-900)}
.higer-cat .hc-card-title a{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden;color:inherit;text-decoration:underline;text-decoration-color:transparent;text-decoration-thickness:2px;text-underline-offset:5px;transition:color .2s,text-decoration-color .2s}
.higer-cat .hc-card-title a:hover,.higer-cat .hc-card-title a:focus-visible{color:var(--hc-navy-700);text-decoration-color:var(--hc-gold-500)}
@media(min-width:1024px){.higer-cat .hc-card-head h2.hc-card-title{font-size:21px}}
.higer-cat .hc-card-head p.hc-card-sub{margin:0;padding:0;font-size:12px;font-weight:600;line-height:1.65;color:#6b7686;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden}
.higer-cat .hc-card-specs{display:flex;flex-wrap:wrap;gap:5px}
.higer-cat .hc-card-specs li{display:inline-flex;align-items:center;gap:4px;padding:4px 8px;border-radius:9px;background:var(--hc-paper);font-size:10px;font-weight:800;line-height:1.6;color:var(--hc-navy-800)}
.higer-cat .hc-card-specs li .hc-i{color:var(--hc-gold-600)}
.higer-cat .hc-card-specs li.is-accent{background:#fdf3d8;border:1px solid rgba(217,161,59,.35)}
.higer-cat .hc-card-specs .hc-mini-meter i{width:8px;height:4px}

.higer-cat .hc-card-price-box{margin-top:auto;padding:10px 12px;border:1px solid var(--hc-line);border-radius:14px;background:var(--hc-cream)}
.higer-cat .hc-card-price-box small{display:block;font-size:10px;font-weight:800;color:var(--hc-navy-600)}
.higer-cat .hc-card-price-row{display:flex;flex-wrap:wrap;align-items:baseline;gap:6px;margin-top:1px}
.higer-cat .hc-card-price-row strong{font-size:15px;font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-card-price-row del{font-size:11px;color:#8a94a3}

.higer-cat .hc-card-actions{display:grid;grid-template-columns:minmax(0,1.25fr) minmax(0,1fr);gap:8px}
.higer-cat .hc-card-actions>:only-child{grid-column:1/-1}
.higer-cat a.hc-btn-primary{display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:10px 12px;border-radius:12px;background:var(--hc-navy-900);color:var(--hc-gold-300);font-size:12px;font-weight:900;white-space:nowrap;transition:background .2s,color .2s}
.higer-cat a.hc-btn-primary:hover{background:var(--hc-gold-500);color:var(--hc-navy-900)}
.higer-cat :is(a,button).hc-btn-sec{display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:10px 10px;border:1px solid var(--hc-line);border-radius:12px;background:#fff;color:var(--hc-navy-800);font-size:11px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s}
.higer-cat :is(a,button).hc-btn-sec:hover{border-color:var(--hc-gold-500);background:var(--hc-cream);color:var(--hc-navy-900)}

/* حالت نمایش فهرستی در دسکتاپ */
@media(min-width:768px){
  .higer-cat .hc-grid[data-view="list"] .hc-card{flex-direction:row;align-items:stretch}
  .higer-cat .hc-grid[data-view="list"] .hc-card-media{width:270px;flex:none;aspect-ratio:auto}
  .higer-cat .hc-grid[data-view="list"] .hc-card-body{padding:20px}
  .higer-cat .hc-grid[data-view="list"] .hc-card-actions{max-width:340px}
}

/* حالت بدون نتیجه */
.higer-cat .hc-empty{padding:48px 24px;border:1px solid var(--hc-line);border-radius:24px;background:#fff;text-align:center;box-shadow:0 12px 30px rgba(16,36,62,.05)}
.higer-cat .hc-empty-ico{display:grid;place-items:center;width:60px;height:60px;margin:0 auto 14px;border-radius:20px;background:var(--hc-paper);color:var(--hc-gold-600)}
.higer-cat .hc-empty h3{font-size:18px;color:var(--hc-navy-900)}
.higer-cat .hc-empty p{max-width:440px;margin:8px auto 0;font-size:13px;line-height:2;color:var(--hc-navy-600)}
.higer-cat .hc-empty-actions{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin-top:20px}

/* ---------- نوار تماس پایین ---------- */
.higer-cat .hc-cta{padding-block:48px;background:radial-gradient(1100px 520px at 85% -10%,rgba(217,161,59,.16),transparent 60%),linear-gradient(160deg,#0b1a30 0%,#10243e 45%,#16304f 100%);color:var(--hc-cream)}
.higer-cat .hc-cta-inner{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:20px}
.higer-cat .hc-cta h2{margin-top:12px;font-size:22px;color:#fff}
@media(min-width:640px){.higer-cat .hc-cta h2{font-size:28px}}
.higer-cat .hc-cta p{display:flex;align-items:flex-start;gap:6px;margin-top:8px;font-size:12px;line-height:2;color:rgba(250,247,239,.74)}
.higer-cat .hc-cta p .hc-i{margin-top:5px;color:var(--hc-gold-400)}

/* ---------- نوار شناور مقایسه ---------- */
.higer-cat.has-cmp-dock .hc-cta{padding-bottom:124px}
.higer-cat .hc-cmp-dock{position:fixed;left:16px;bottom:14px;z-index:9985;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;width:fit-content;max-width:calc(100vw - 32px);padding:10px 14px;border:1px solid rgba(217,161,59,.48);border-radius:20px;background:rgba(16,36,62,.96);color:var(--hc-cream);box-shadow:0 20px 50px rgba(7,15,29,.5);backdrop-filter:blur(10px)}
.higer-cat .hc-cmp-dock-info{display:flex;align-items:center;gap:10px;min-width:0}
.higer-cat .hc-cmp-dock-ico{display:grid;flex:none;place-items:center;width:38px;height:38px;border-radius:12px;background:rgba(217,161,59,.18);color:var(--hc-gold-300)}
.higer-cat .hc-cmp-dock-info b{display:block;font-size:12px;font-weight:900;color:var(--hc-gold-300)}
.higer-cat .hc-cmp-dock-pills{display:flex;flex-wrap:wrap;gap:5px;margin-top:4px}
.higer-cat button.hc-dock-pill{display:inline-flex;align-items:center;gap:4px;padding:2px 8px;border-radius:9999px;background:rgba(255,255,255,.12);font-size:11px;font-weight:700;color:#fff}
.higer-cat button.hc-dock-pill:hover{background:rgba(185,28,28,.65)}
.higer-cat .hc-cmp-dock-actions{display:flex;align-items:center;gap:8px;margin-right:auto}
.higer-cat button.hc-cmp-clear{padding:8px 12px;border:1px solid rgba(255,255,255,.22);border-radius:9999px;font-size:11px;font-weight:800;color:rgba(250,247,239,.85)}
.higer-cat button.hc-cmp-clear:hover{border-color:#fca5a5;color:#fecaca}

/* ---------- مودال‌های مشاهده سریع سایزها و مقایسه ---------- */
.higer-cat .hc-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:14px}
.higer-cat .hc-modal-backdrop{position:absolute;inset:0;background:rgba(7,15,29,.68);backdrop-filter:blur(4px)}
.higer-cat .hc-modal-card{position:relative;z-index:1;display:flex;flex-direction:column;width:100%;max-height:calc(100vh - 28px);overflow:hidden;border:1px solid var(--hc-line);border-radius:26px;background:#fff;box-shadow:0 30px 80px rgba(7,15,29,.5)}
.higer-cat .hc-quick-card{max-width:680px;overflow-y:auto;padding:20px}
@media(min-width:640px){.higer-cat .hc-quick-card{padding:26px}}
.higer-cat .hc-cmp-card{max-width:1120px}
.higer-cat .hc-modal-head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;padding:18px 22px;border-bottom:1px solid var(--hc-line);background:var(--hc-cream)}
.higer-cat .hc-modal-head h3{margin-top:6px;font-size:18px;color:var(--hc-navy-900)}
.higer-cat .hc-cmp-modal-tools{display:flex;align-items:center;gap:10px}
.higer-cat .hc-cmp-size-pick{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:800;color:var(--hc-navy-700)}
.higer-cat .hc-cmp-size-pick select{height:38px;padding:0 12px;border:1.5px solid var(--hc-line);border-radius:9999px;background:#fff;font:inherit;font-size:12px;font-weight:800;color:var(--hc-navy-900)}
.higer-cat button.hc-modal-close{display:grid;flex:none;place-items:center;width:36px;height:36px;border:1px solid var(--hc-line);border-radius:50%;background:#fff;color:var(--hc-navy-900)}
.higer-cat button.hc-modal-close:hover{border-color:var(--hc-gold-500)}
.higer-cat .hc-modal-scroll{overflow:auto}

/* جدول مقایسه داخل مودال */
.higer-cat .hc-cmp-table{width:100%;border-collapse:collapse;font-size:13px}
.higer-cat .hc-cmp-table :is(th,td){padding:13px 16px;border-bottom:1px solid var(--hc-line);text-align:right;vertical-align:middle;white-space:nowrap}
.higer-cat .hc-cmp-table thead th{background:var(--hc-navy-900);color:var(--hc-gold-300);font-size:13px;font-weight:900}
.higer-cat .hc-cmp-table th[scope="row"]{position:sticky;right:0;z-index:1;background:var(--hc-cream);color:var(--hc-navy-700);font-weight:800;box-shadow:-1px 0 0 var(--hc-line)}
.higer-cat .hc-cmp-table thead th:first-child{position:sticky;right:0;z-index:2}
.higer-cat .hc-cmp-col-head{display:flex;align-items:center;justify-content:space-between;gap:10px}
.higer-cat .hc-cmp-col-head a{color:#fff;text-decoration:underline;text-underline-offset:3px}
.higer-cat button.hc-cmp-rm{display:grid;place-items:center;width:24px;height:24px;border-radius:50%;background:rgba(255,255,255,.14);color:#fff}
.higer-cat button.hc-cmp-rm:hover{background:var(--hc-bad)}

/* محتوای مودال مشاهده سریع سایزها */
.higer-cat .hc-qv-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px}
.higer-cat .hc-qv-top h3{font-size:22px;color:var(--hc-navy-900)}
.higer-cat .hc-qv-sub{margin-top:2px;font-size:13px;font-weight:700;color:var(--hc-navy-600)}
.higer-cat .hc-qv-price{margin-top:14px;padding:12px 16px;border:1px solid var(--hc-line);border-radius:16px;background:var(--hc-cream)}
.higer-cat .hc-qv-price small{display:block;font-size:11px;font-weight:800;color:var(--hc-navy-600)}
.higer-cat .hc-qv-price strong{font-size:20px;font-weight:900;color:var(--hc-navy-900)}
.higer-cat .hc-qv-sizes{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-top:14px}
@media(min-width:460px){.higer-cat .hc-qv-sizes{grid-template-columns:repeat(3,minmax(0,1fr))}}
.higer-cat button.hc-qv-size{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:10px 6px;border:1.5px solid var(--hc-line);border-radius:14px;background:#fffdf6;text-align:center;transition:border-color .2s,background .2s}
.higer-cat button.hc-qv-size:hover{border-color:var(--hc-gold-500)}
.higer-cat button.hc-qv-size[aria-pressed="true"]{border-color:var(--hc-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);box-shadow:inset 0 0 0 1px rgba(217,161,59,.45)}
.higer-cat button.hc-qv-size:disabled{opacity:.42;cursor:not-allowed}
.higer-cat .hc-qv-size b{font-size:14px;font-weight:900}
.higer-cat .hc-qv-size small{min-height:15px;font-size:10px;font-weight:700;color:var(--hc-navy-600)}
.higer-cat .hc-qv-size span{font-size:11px;font-weight:800;color:var(--hc-gold-600)}
.higer-cat .hc-qv-foot{display:flex;flex-wrap:wrap;align-items:stretch;gap:10px;margin-top:18px;padding-top:16px;border-top:1px solid var(--hc-line)}
.higer-cat .hc-qty{display:flex;align-items:center;overflow:hidden;border:1.5px solid var(--hc-line);border-radius:9999px;background:#fff}
.higer-cat .hc-qty button{display:grid;place-items:center;width:36px;height:44px;color:var(--hc-navy-900)}
.higer-cat .hc-qty button:hover{background:var(--hc-paper)}
.higer-cat .hc-qty input{width:38px;height:44px;border:0;background:transparent;text-align:center;font:inherit;font-size:14px;font-weight:900;color:var(--hc-navy-900);-moz-appearance:textfield;appearance:textfield}
.higer-cat .hc-qty input::-webkit-inner-spin-button,.higer-cat .hc-qty input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}
.higer-cat .hc-qv-foot .hc-btn-gold{flex:1;min-width:170px}

@media(prefers-reduced-motion:reduce){.higer-cat *,.higer-cat *::before,.higer-cat *::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}}
</style>
<script id="higer-cat-js">
/* ============ هیگر — اسکریپت صفحه فروشگاه و فیلترهای پیشرفته (خوانا و بدون بیلد) ============ */
(function () {
  'use strict';

  var FONTS = [
    'https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css',
    'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css'
  ];
  var FA_DIGITS = '۰۱۲۳۴۵۶۷۸۹';

  function toFa(val) {
    return String(val).replace(/[0-9]/g, function (d) { return FA_DIGITS[+d]; });
  }
  function faNum(n) {
    return toFa(Math.round(Number(n) || 0).toLocaleString('en-US'));
  }
  function faMoney(n) {
    return faNum(n) + ' تومان';
  }
  function normText(s) {
    return String(s == null ? '' : s)
      .replace(/[۰-۹]/g, function (d) { return String('۰۱۲۳۴۵۶۷۸۹'.indexOf(d)); })
      .replace(/[٠-٩]/g, function (d) { return String('٠١٢٣٤٥٦٧٨٩'.indexOf(d)); })
      .replace(/ي/g, 'ی')
      .replace(/ك/g, 'ک')
      .replace(/\u200c/g, ' ')
      .toLowerCase()
      .trim();
  }
  function esc(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }
  function addFonts() {
    var head = document.head || document.documentElement;
    FONTS.forEach(function (href) {
      if (document.querySelector('link[href="' + href + '"]')) return;
      var link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = href;
      head.appendChild(link);
    });
  }

  function mount(root) {
    if (root.getAttribute('data-hc-mounted')) return;
    var source = root.querySelector('script[data-hc-data]');
    var data;
    try { data = JSON.parse(source ? source.textContent : '{}'); } catch (e) { return; }
    root.setAttribute('data-hc-mounted', '1');

    function one(sel) { return root.querySelector(sel); }
    function all(sel) { return Array.prototype.slice.call(root.querySelectorAll(sel)); }

    var products = data.products || [];
    var byId = {};
    var cmpById = {};
    (data.comparePool || []).forEach(function (cp) {
      cmpById[cp.id] = cp;
    });
    products.forEach(function (p) {
      p._normSearch = normText(p.search || (p.name + ' ' + p.short));
      byId[p.id] = p;
      cmpById[p.id] = p;
    });

    var categories = data.categories || [];
    var catBySlug = {};
    categories.forEach(function (c) { catBySlug[c.slug] = c; });

    var facets = data.facets || {};
    var boundMin = Number(data.minPrice) || 0;
    var boundMax = Number(data.maxPrice) || 0;
    var init = data.initial || {};
    var baseCat = init.baseCategory || '';

    var state = {
      search: init.search || '',
      category: init.category || baseCat,
      size: init.size || '',
      minPrice: boundMin,
      maxPrice: boundMax,
      firmness: (init.firmness || []).slice(),
      layer: (init.layer || []).slice(),
      warranty: (init.warranty || []).slice(),
      spring: (init.spring || []).slice(),
      special: (init.special || []).slice(),
      fabric: (init.fabric || []).slice(),
      extra: {},
      hideOut: !!init.hideOut,
      onSale: false,
      sort: 'default',
      view: 'grid'
    };

    /* خواندن پارامترهای آدرس برای لینک‌های اشتراکی و فیلترهای ووکامرس */
    try {
      var sp = new URLSearchParams(window.location.search);
      var qCat = sp.get('cat') || sp.get('product_cat') || sp.get('filter_cat');
      if (qCat && (catBySlug[qCat] || qCat === baseCat)) state.category = qCat;
      var qSize = sp.get('size') || sp.get('filter_size') || sp.get('attribute_pa_size');
      if (qSize) state.size = qSize;
      var qSearch = sp.get('q') || sp.get('s');
      if (qSearch !== null && qSearch !== '') state.search = qSearch;
      if (sp.get('min_price')) state.minPrice = Math.max(boundMin, Number(sp.get('min_price')) || boundMin);
      if (sp.get('max_price')) state.maxPrice = Math.min(boundMax, Number(sp.get('max_price')) || boundMax);
      if (sp.get('show_out_of_stock') === '1') state.hideOut = false;
      else if (sp.get('in_stock') === '1') state.hideOut = true;
      if (sp.get('on_sale') === '1') state.onSale = true;
      if (sp.get('sort')) state.sort = sp.get('sort');
      ['firmness', 'layer', 'warranty', 'spring', 'special', 'fabric'].forEach(function (fk) {
        var raw = sp.get(fk) || sp.get('filter_' + fk);
        if (raw) state[fk] = raw.split(',').filter(Boolean);
      });
    } catch (e) { /* مرورگر قدیمی */ }

    var cardNodes = {};
    all('[data-hc-card]').forEach(function (el) {
      cardNodes[Number(el.getAttribute('data-hc-card'))] = el;
    });

    /* قیمت مؤثر محصول با توجه به سایز انتخابی */
    function effectivePrice(p, sizeSlug) {
      var sz = sizeSlug !== undefined ? sizeSlug : state.size;
      if (sz && p.sizes && p.sizes[sz] && p.sizes[sz].price > 0) {
        return p.sizes[sz].price;
      }
      return p.min || 0;
    }

    /* بررسی انطباق محصول با همه فیلترها به‌جز فیلتر skipKey (برای شمارش زنده گزینه‌ها) */
    function matches(p, skipKey) {
      if (skipKey !== 'stock' && state.hideOut && !p.inStock) return false;
      if (skipKey !== 'onSale' && state.onSale && !p.onSale) return false;

      if (skipKey !== 'search' && state.search) {
        var words = normText(state.search).split(/\s+/).filter(Boolean);
        for (var w = 0; w < words.length; w++) {
          if (p._normSearch.indexOf(words[w]) === -1) return false;
        }
      }

      if (skipKey !== 'category' && state.category) {
        if ((p.catSlugs || []).indexOf(state.category) === -1) return false;
      }

      if (skipKey !== 'size' && state.size) {
        if (!p.sizes || !p.sizes[state.size]) return false;
      }

      if (skipKey !== 'price' && boundMax > 0 && (state.minPrice > boundMin || state.maxPrice < boundMax)) {
        if (state.size && p.sizes && p.sizes[state.size]) {
          var sp = p.sizes[state.size].price;
          if (sp < state.minPrice || sp > state.maxPrice) return false;
        } else {
          if (p.max < state.minPrice || p.min > state.maxPrice) return false;
        }
      }

      if (skipKey !== 'firmness' && state.firmness.length) {
        if (!p.firmness || state.firmness.indexOf(p.firmness.slug) === -1) return false;
      }
      if (skipKey !== 'layer' && state.layer.length) {
        if (!p.layer || state.layer.indexOf(p.layer.slug) === -1) return false;
      }
      if (skipKey !== 'warranty' && state.warranty.length) {
        if (!p.warranty || state.warranty.indexOf(p.warranty.slug) === -1) return false;
      }
      if (skipKey !== 'spring' && state.spring.length) {
        var pSprings = (p.spring || []).map(function (x) { return x.slug; });
        if (!state.spring.some(function (s) { return pSprings.indexOf(s) > -1; })) return false;
      }
      if (skipKey !== 'special' && state.special.length) {
        var pSpec = (p.special || []).map(function (x) { return x.slug; });
        if (!state.special.some(function (s) { return pSpec.indexOf(s) > -1; })) return false;
      }
      if (skipKey !== 'fabric' && state.fabric.length) {
        var pFab = (p.fabric || []).map(function (x) { return x.slug; });
        if (!state.fabric.some(function (s) { return pFab.indexOf(s) > -1; })) return false;
      }

      var extraTaxes = Object.keys(state.extra);
      for (var i = 0; i < extraTaxes.length; i++) {
        var tx = extraTaxes[i];
        if (skipKey === 'extra:' + tx) continue;
        var chosen = state.extra[tx] || [];
        if (!chosen.length) continue;
        var pEx = p.extra && p.extra[tx] ? p.extra[tx].items.map(function (x) { return x.slug; }) : [];
        if (!chosen.some(function (s) { return pEx.indexOf(s) > -1; })) return false;
      }

      return true;
    }

    function toggleInArray(arr, val) {
      var idx = arr.indexOf(val);
      if (idx > -1) arr.splice(idx, 1);
      else arr.push(val);
    }

    function labelForFacet(group, slug) {
      var list = facets[group] || [];
      for (var i = 0; i < list.length; i++) {
        if (list[i].slug === slug) return list[i].label || list[i].name || slug;
      }
      return slug;
    }

    function updatePriceSliderUI() {
      var rMin = one('[data-hc-price-min]');
      var rMax = one('[data-hc-price-max]');
      var outMin = one('[data-hc-price-min-out]');
      var outMax = one('[data-hc-price-max-out]');
      var fill = one('[data-hc-range-fill]');
      if (rMin) rMin.value = state.minPrice;
      if (rMax) rMax.value = state.maxPrice;
      if (outMin) outMin.textContent = faNum(state.minPrice);
      if (outMax) outMax.textContent = faNum(state.maxPrice);
      var priceReset = one('[data-hc-price-reset]');
      if (priceReset) {
        var priceChanged = state.minPrice > boundMin || state.maxPrice < boundMax;
        priceReset.hidden = !priceChanged;
        priceReset.classList.toggle('is-visible', priceChanged);
      }
      if (fill && boundMax > boundMin) {
        /* اسلایدر RTL است: مقدار کمتر سمت راست و مقدار بیشتر سمت چپ قرار می‌گیرد. */
        var p1 = ((state.minPrice - boundMin) / (boundMax - boundMin)) * 100;
        var p2 = ((state.maxPrice - boundMin) / (boundMax - boundMin)) * 100;
        fill.style.right = Math.max(0, Math.min(100, p1)) + '%';
        fill.style.left = Math.max(0, Math.min(100, 100 - p2)) + '%';
      }
      all('[data-hc-preset-min]').forEach(function (btn) {
        var pMin = Number(btn.getAttribute('data-hc-preset-min')) || 0;
        var pMax = Number(btn.getAttribute('data-hc-preset-max')) || 0;
        var effMin = pMin > 0 ? Math.max(boundMin, pMin) : boundMin;
        var effMax = pMax > 0 ? Math.min(boundMax, pMax) : boundMax;
        btn.classList.toggle('is-on', state.minPrice === effMin && state.maxPrice === effMax);
      });
    }

    function updateFacetCounts() {
      /* دسته‌ها */
      var baseCat = products.filter(function (p) { return matches(p, 'category'); });
      all('[data-hc-count="cat:"], [data-hc-cat-pill-count=""]').forEach(function (el) {
        el.textContent = toFa(baseCat.length);
      });
      if (baseCat) {
        all('[data-hc-count="cat:' + baseCat + '"], [data-hc-cat-pill-count="' + baseCat + '"]').forEach(function (el) {
          el.textContent = toFa(baseCat.length);
        });
      }
      categories.forEach(function (cat) {
        var n = baseCat.filter(function (p) { return (p.catSlugs || []).indexOf(cat.slug) > -1; }).length;
        all('[data-hc-count="cat:' + cat.slug + '"], [data-hc-cat-pill-count="' + cat.slug + '"]').forEach(function (el) {
          el.textContent = toFa(n);
        });
        all('.hc-cat-row[data-hc-cat="' + cat.slug + '"]').forEach(function (btn) {
          btn.classList.toggle('is-zero', n === 0);
        });
      });

      /* سایزها */
      var baseSize = products.filter(function (p) { return matches(p, 'size'); });
      (facets.sizes || []).forEach(function (sz) {
        var n = baseSize.filter(function (p) {
          if (!p.sizes || !p.sizes[sz.slug]) return false;
          return state.hideOut ? !!p.sizes[sz.slug].inStock : true;
        }).length;
        var cntEl = one('[data-hc-count="size:' + sz.slug + '"]');
        if (cntEl) cntEl.textContent = '(' + toFa(n) + ')';
        all('[data-hc-size="' + sz.slug + '"]').forEach(function (btn) {
          btn.classList.toggle('is-zero', n === 0);
        });
      });

      /* ویژگی‌های چندانتخابی */
      var singlePropGroups = [
        { key: 'firmness', list: facets.firmness || [], prop: 'firmness' },
        { key: 'layer', list: facets.layers || [], prop: 'layer' },
        { key: 'warranty', list: facets.warranty || [], prop: 'warranty' }
      ];
      singlePropGroups.forEach(function (g) {
        var pool = products.filter(function (p) { return matches(p, g.key); });
        g.list.forEach(function (item) {
          var n = pool.filter(function (p) { return p[g.prop] && p[g.prop].slug === item.slug; }).length;
          var el = one('[data-hc-count="' + g.key + ':' + item.slug + '"]');
          if (el) el.textContent = toFa(n);
          all('[data-hc-facet="' + g.key + '"][data-value="' + item.slug + '"]').forEach(function (btn) {
            btn.classList.toggle('is-zero', n === 0);
          });
        });
      });

      ['spring', 'special', 'fabric'].forEach(function (gk) {
        var pool = products.filter(function (p) { return matches(p, gk); });
        (facets[gk] || []).forEach(function (item) {
          var n = pool.filter(function (p) {
            return (p[gk] || []).some(function (x) { return x.slug === item.slug; });
          }).length;
          var el = one('[data-hc-count="' + gk + ':' + item.slug + '"]');
          if (el) el.textContent = toFa(n);
          all('[data-hc-facet="' + gk + '"][data-value="' + item.slug + '"]').forEach(function (btn) {
            btn.classList.toggle('is-zero', n === 0);
          });
        });
      });

      (facets.extra || []).forEach(function (ex) {
        var pool = products.filter(function (p) { return matches(p, 'extra:' + ex.tax); });
        (ex.terms || []).forEach(function (item) {
          var n = pool.filter(function (p) {
            var items = p.extra && p.extra[ex.tax] ? p.extra[ex.tax].items : [];
            return items.some(function (x) { return x.slug === item.slug; });
          }).length;
          var el = one('[data-hc-count="extra:' + ex.tax + ':' + item.slug + '"]');
          if (el) el.textContent = toFa(n);
          all('[data-hc-extra="' + ex.tax + '"][data-value="' + item.slug + '"]').forEach(function (btn) {
            btn.classList.toggle('is-zero', n === 0);
          });
        });
      });
    }

    function buildActiveChips() {
      var chips = [];
      if (state.search) {
        chips.push({ type: 'search', label: 'جستجو: ' + state.search });
      }
      if (state.category && state.category !== baseCat && catBySlug[state.category]) {
        chips.push({ type: 'category', label: (baseCat ? 'زیرمجموعه: ' : 'دسته: ') + catBySlug[state.category].name });
      }
      if (state.size) {
        chips.push({ type: 'size', label: 'سایز: ' + labelForFacet('sizes', state.size) });
      }
      if (boundMax > 0 && (state.minPrice > boundMin || state.maxPrice < boundMax)) {
        chips.push({ type: 'price', label: 'قیمت: ' + faNum(state.minPrice) + ' تا ' + faMoney(state.maxPrice) });
      }
      if (!state.hideOut && init.hideOut) chips.push({ type: 'stock', label: 'نمایش ناموجودها' });
      if (state.onSale) chips.push({ type: 'onSale', label: 'تخفیف‌دار' });

      var multiMeta = [
        { k: 'firmness', f: 'firmness', t: 'سفتی' },
        { k: 'layer', f: 'layers', t: 'چیدمان' },
        { k: 'warranty', f: 'warranty', t: 'گارانتی' },
        { k: 'spring', f: 'spring', t: 'فنر' },
        { k: 'special', f: 'special', t: 'لایه ویژه' },
        { k: 'fabric', f: 'fabric', t: 'پارچه' }
      ];
      multiMeta.forEach(function (m) {
        state[m.k].forEach(function (slug) {
          chips.push({ type: 'facet', key: m.k, value: slug, label: m.t + ': ' + labelForFacet(m.f, slug) });
        });
      });
      Object.keys(state.extra).forEach(function (tx) {
        (state.extra[tx] || []).forEach(function (slug) {
          chips.push({ type: 'extra', key: tx, value: slug, label: slug });
        });
      });
      return chips;
    }

    function syncUrl() {
      if (!window.history || !window.history.replaceState) return;
      try {
        var url = new URL(window.location.href);
        ['cat', 'size', 'firmness', 'layer', 'warranty', 'spring', 'special', 'fabric', 'min_price', 'max_price', 'show_out_of_stock', 'on_sale', 'sort', 'q'].forEach(function (k) {
          url.searchParams.delete(k);
        });
        if (state.category && state.category !== baseCat && state.category !== (init.category || '')) url.searchParams.set('cat', state.category);
        if (state.size && state.size !== (init.size || '')) url.searchParams.set('size', state.size);
        if (state.search && state.search !== (init.search || '')) url.searchParams.set('q', state.search);
        if (boundMax > 0 && state.minPrice > boundMin) url.searchParams.set('min_price', String(state.minPrice));
        if (boundMax > 0 && state.maxPrice < boundMax) url.searchParams.set('max_price', String(state.maxPrice));
        if (!state.hideOut && init.hideOut) url.searchParams.set('show_out_of_stock', '1');
        if (state.onSale) url.searchParams.set('on_sale', '1');
        if (state.sort !== 'default') url.searchParams.set('sort', state.sort);
        ['firmness', 'layer', 'warranty', 'spring', 'special', 'fabric'].forEach(function (fk) {
          if (state[fk].length) url.searchParams.set(fk, state[fk].join(','));
        });
        window.history.replaceState(null, '', url.toString());
      } catch (e) { /* در iframe srcdoc تغییر URL مجاز نیست */ }
    }

    function render() {
      /* همگام‌سازی کنترل‌های فرم */
      var qInput = one('[data-hc-search]');
      if (qInput && qInput.value !== state.search) qInput.value = state.search;
      var qClear = one('[data-hc-search-clear]');
      if (qClear) qClear.hidden = !state.search;

      var showOutChk = one('[data-hc-showout]');
      if (showOutChk) showOutChk.checked = !state.hideOut;
      var onSaleChk = one('[data-hc-onsale]');
      if (onSaleChk) onSaleChk.checked = state.onSale;

      all('[data-hc-cat]').forEach(function (btn) {
        btn.setAttribute('aria-pressed', btn.getAttribute('data-hc-cat') === state.category ? 'true' : 'false');
      });
      all('[data-hc-size]').forEach(function (btn) {
        btn.setAttribute('aria-pressed', btn.getAttribute('data-hc-size') === state.size ? 'true' : 'false');
      });
      ['firmness', 'layer', 'warranty', 'spring', 'special', 'fabric'].forEach(function (fk) {
        all('[data-hc-facet="' + fk + '"]').forEach(function (btn) {
          var on = state[fk].indexOf(btn.getAttribute('data-value')) > -1;
          btn.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
      });
      all('[data-hc-extra]').forEach(function (btn) {
        var tx = btn.getAttribute('data-hc-extra');
        var list = state.extra[tx] || [];
        btn.setAttribute('aria-pressed', list.indexOf(btn.getAttribute('data-value')) > -1 ? 'true' : 'false');
      });
      all('[data-hc-sort]').forEach(function (sel) {
        if (sel.value !== state.sort) sel.value = state.sort;
      });
      all('[data-hc-view]').forEach(function (btn) {
        btn.setAttribute('aria-pressed', btn.getAttribute('data-hc-view') === state.view ? 'true' : 'false');
      });
      var grid = one('[data-hc-grid]');
      if (grid) grid.setAttribute('data-view', state.view);

      /* هماهنگی زنده سربرگ با دسته‌بندی انتخاب‌شده */
      var hDef = data.heroDefault || null;
      var hCores = data.heroCores || {};
      var hTitle = one('[data-hc-hero-title]');
      var hSub = one('[data-hc-hero-sub]');
      var hKick = one('[data-hc-hero-kicker]');
      var hArt = one('[data-hc-hero-art]');
      if (!baseCat && hDef && !state.search) {
        if (state.category && catBySlug[state.category]) {
          var cObj = catBySlug[state.category];
          var cHero = hCores[state.category] || null;
          if (hKick) hKick.textContent = 'دسته‌بندی محصولات';
          if (hTitle) hTitle.textContent = cObj.name;
          if (hSub && cHero && cHero.text) hSub.textContent = cHero.text;
          if (hArt && cHero && cHero.svg) hArt.innerHTML = cHero.svg;
        } else {
          if (hKick) hKick.textContent = hDef.kicker;
          if (hTitle) hTitle.textContent = hDef.title;
          if (hSub) hSub.textContent = hDef.subtitle;
          if (hArt && hDef.svg) hArt.innerHTML = hDef.svg;
        }
      }

      updatePriceSliderUI();
      updateFacetCounts();

      /* فیلتر و مرتب‌سازی محصولات */
      var matched = products.filter(function (p) { return matches(p, ''); });
      matched.sort(function (a, b) {
        if (state.sort === 'price-asc') return effectivePrice(a) - effectivePrice(b);
        if (state.sort === 'price-desc') return effectivePrice(b) - effectivePrice(a);
        if (state.sort === 'warranty-desc') {
          var wa = a.warranty ? a.warranty.years : 0;
          var wb = b.warranty ? b.warranty.years : 0;
          return wb !== wa ? wb - wa : effectivePrice(a) - effectivePrice(b);
        }
        if (state.sort === 'firm-asc') {
          var fa1 = a.firmness ? a.firmness.level : 99;
          var fb1 = b.firmness ? b.firmness.level : 99;
          return fa1 !== fb1 ? fa1 - fb1 : effectivePrice(a) - effectivePrice(b);
        }
        if (state.sort === 'firm-desc') {
          var fa2 = a.firmness ? a.firmness.level : 0;
          var fb2 = b.firmness ? b.firmness.level : 0;
          return fb2 !== fa2 ? fb2 - fa2 : effectivePrice(a) - effectivePrice(b);
        }
        if (state.sort === 'name-asc') return String(a.name).localeCompare(String(b.name));
        return a.order - b.order;
      });

      var matchedMap = {};
      matched.forEach(function (p) { matchedMap[p.id] = true; });

      var sizeLabel = state.size ? labelForFacet('sizes', state.size) : '';
      products.forEach(function (p) {
        var card = cardNodes[p.id];
        if (!card) return;
        var vis = !!matchedMap[p.id];
        card.hidden = !vis;
        if (!vis) return;

        /* به‌روزرسانی قیمت کارت و لینک صفحه محصول بر اساس سایز انتخابی */
        var pLabel = one('[data-hc-card-plabel="' + p.id + '"]');
        var pVal = one('[data-hc-card-price="' + p.id + '"]');
        var pReg = one('[data-hc-card-reg="' + p.id + '"]');
        if (state.size && p.sizes && p.sizes[state.size]) {
          var sv = p.sizes[state.size];
          if (pLabel) pLabel.textContent = 'قیمت سایز ' + sizeLabel;
          if (pVal) pVal.textContent = sv.priceText || p.rangeText;
          if (pReg) {
            pReg.textContent = sv.regularText || '';
            pReg.hidden = !sv.regularText;
          }
        } else {
          if (pLabel) pLabel.textContent = p.max > p.min ? 'محدوده قیمت' : 'قیمت';
          if (pVal) pVal.textContent = p.rangeText;
          if (pReg) { pReg.textContent = ''; pReg.hidden = true; }
        }

        var targetHref = p.url;
        if (state.size && p.sizeKey && p.sizes && p.sizes[state.size]) {
          targetHref = p.url + (p.url.indexOf('?') > -1 ? '&' : '?') + 'attribute_' + encodeURIComponent(p.sizeKey) + '=' + encodeURIComponent(state.size);
        }
        Array.prototype.forEach.call(card.querySelectorAll('[data-hc-link="' + p.id + '"]'), function (lnk) {
          lnk.setAttribute('href', targetHref);
        });
      });

      /* چیدمان مجدد DOM بر اساس ترتیب مرتب‌سازی */
      if (grid) {
        matched.forEach(function (p) {
          if (cardNodes[p.id]) grid.appendChild(cardNodes[p.id]);
        });
      }

      var countFa = toFa(matched.length);
      all('[data-hc-shown-count], [data-hc-result-num]').forEach(function (el) { el.textContent = countFa; });
      if (baseCat) {
        var heroBadge = one('[data-hc-total-badge]');
        if (heroBadge) heroBadge.textContent = countFa + ' مدل';
      }
      var empty = one('[data-hc-empty]');
      if (empty) empty.hidden = matched.length > 0;
      if (grid) grid.hidden = matched.length === 0;

      var sizeBanner = one('[data-hc-size-banner]');
      if (sizeBanner) {
        sizeBanner.hidden = !state.size;
        sizeBanner.textContent = state.size ? 'قیمت‌ها برای سایز ' + sizeLabel : '';
      }

      /* چیپ‌های فیلتر فعال */
      var chips = buildActiveChips();
      all('[data-hc-active-count]').forEach(function (b) {
        b.textContent = toFa(chips.length);
        b.hidden = chips.length === 0;
      });
      all('.hc-reset-link').forEach(function (btn) {
        btn.hidden = chips.length === 0;
        btn.classList.toggle('is-visible', chips.length > 0);
      });
      all('[data-hc-active-chips]').forEach(function (chipsWrap) {
        chipsWrap.innerHTML = chips.map(function (c, i) {
          return '<button type="button" class="hc-chip" data-hc-rm-chip="' + i + '">' + esc(c.label) + ' <span aria-hidden="true">×</span></button>';
        }).join('');
        chipsWrap._chips = chips;
      });
      var activeBar = one('[data-hc-active-bar]');
      if (activeBar) activeBar.hidden = chips.length === 0;
      var sidebarBar = one('.hc-sidebar-head');
      if (sidebarBar) sidebarBar.classList.toggle('has-filters', chips.length > 0);

      syncUrl();
    }

    function resetAll() {
      state.search = '';
      state.category = baseCat;
      state.size = '';
      state.minPrice = boundMin;
      state.maxPrice = boundMax;
      state.firmness = [];
      state.layer = [];
      state.warranty = [];
      state.spring = [];
      state.special = [];
      state.fabric = [];
      state.extra = {};
      state.hideOut = !!init.hideOut;
      state.onSale = false;
      render();
    }

    /* ---------- دراور فیلتر موبایل ---------- */
    var sidebar = one('[data-hc-sidebar]');
    var backdrop = one('.hc-backdrop');
    var drawerBtn = one('[data-hc-drawer-open]');
    function setDrawer(open) {
      if (!sidebar) return;
      if (open) syncStickyOffset();
      sidebar.classList.toggle('is-open', !!open);
      if (backdrop) backdrop.hidden = !open;
      if (drawerBtn) drawerBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      document.documentElement.style.overflow = open ? 'hidden' : '';
    }

    /* ---------- سیستم مقایسه (مشترک با صفحه تک‌محصول از طریق localStorage['higer-compare']) ---------- */
    var CMP_KEY = 'higer-compare';
    var cmpSize = '';
    function readBasket() {
      try {
        var raw = JSON.parse(window.localStorage.getItem(CMP_KEY) || '[]');
        return Array.isArray(raw) ? raw.map(Number).filter(function (id) { return !!cmpById[id]; }) : [];
      } catch (e) { return []; }
    }
    function writeBasket(list) {
      try { window.localStorage.setItem(CMP_KEY, JSON.stringify(list)); } catch (e) { /* نادیده */ }
    }
    var basket = readBasket();

    function renderCompareUI() {
      all('[data-hc-cmp]').forEach(function (btn) {
        var id = Number(btn.getAttribute('data-hc-cmp'));
        btn.setAttribute('aria-pressed', basket.indexOf(id) > -1 ? 'true' : 'false');
      });
      var dock = one('[data-hc-cmp-dock]');
      var dockCnt = one('[data-hc-cmp-count]');
      var pills = one('[data-hc-cmp-pills]');
      if (dock) dock.hidden = basket.length === 0;
      root.classList.toggle('has-cmp-dock', basket.length > 0);
      if (dockCnt) dockCnt.textContent = '(' + toFa(basket.length) + ')';
      if (pills) {
        pills.innerHTML = basket.map(function (id) {
          var p = cmpById[id];
          return p ? '<button type="button" class="hc-dock-pill" data-hc-cmp-rm="' + id + '" title="حذف از مقایسه">' + esc(p.name) + ' ×</button>' : '';
        }).join('');
      }
      var cmpModal = one('[data-hc-cmp-modal]');
      if (cmpModal && !cmpModal.hidden) renderCompareTable();
    }

    function toggleCompare(id) {
      if (!cmpById[id]) return;
      var at = basket.indexOf(id);
      if (at > -1) basket.splice(at, 1);
      else basket.push(id);
      writeBasket(basket);
      renderCompareUI();
    }

    function renderCompareTable() {
      var wrap = one('[data-hc-cmp-table-wrap]');
      if (!wrap) return;
      var items = basket.map(function (id) { return cmpById[id]; }).filter(Boolean);
      if (!items.length) {
        wrap.innerHTML = '<p style="padding:28px;text-align:center;font-weight:700">هیچ مدلی در فهرست مقایسه نیست.</p>';
        return;
      }
      var activeSz = cmpSize || state.size || '';
      var cmpSel = one('[data-hc-cmp-size]');
      if (cmpSel && cmpSel.value !== activeSz) cmpSel.value = activeSz;
      var szTitle = activeSz ? 'قیمت سایز ' + labelForFacet('sizes', activeSz) : 'محدوده قیمت';

      var headCols = items.map(function (p) {
        return '<th scope="col"><div class="hc-cmp-col-head"><a href="' + esc(p.url) + '">' + esc(p.name) + '</a><button type="button" class="hc-cmp-rm" data-hc-cmp-rm="' + p.id + '" aria-label="حذف">×</button></div></th>';
      }).join('');

      var rows = [
        { label: szTitle, fn: function (p) {
          if (activeSz) {
            return p.sizes && p.sizes[activeSz] && p.sizes[activeSz].priceText ? '<b>' + esc(p.sizes[activeSz].priceText) + '</b>' : '—';
          }
          return '<b>' + esc(p.rangeText) + '</b>';
        } },
        { label: 'نوع هسته / دسته', fn: function (p) { return esc(p.core && p.core.title ? p.core.title : (p.primaryCat ? p.primaryCat.name : '—')); } },
        { label: 'درجه سفتی', fn: function (p) {
          if (!p.firmness) return '—';
          var m = '';
          if (p.firmness.level) {
            m = ' <span class="hc-mini-meter">';
            for (var i = 1; i <= (p.firmness.max || 4); i++) m += '<i' + (i <= p.firmness.level ? ' class="is-on"' : '') + '></i>';
            m += '</span>';
          }
          return esc(p.firmness.name) + m;
        } },
        { label: 'گارانتی', fn: function (p) { return p.warranty ? esc(p.warranty.name) : '—'; } },
        { label: 'چیدمان لایه‌ها', fn: function (p) { return p.layer ? esc(p.layer.name) : '—'; } },
        { label: 'نوع فنر', fn: function (p) { return p.spring && p.spring.length ? esc(p.spring.map(function (x) { return x.name; }).join('، ')) : '—'; } },
        { label: 'لایه ویژه', fn: function (p) { return p.special && p.special.length ? esc(p.special.map(function (x) { return x.name; }).join('، ')) : '—'; } },
        { label: 'جنس پارچه', fn: function (p) { return p.fabric && p.fabric.length ? esc(p.fabric.map(function (x) { return x.name; }).join('، ')) : '—'; } },
        { label: 'سایزهای موجود', fn: function (p) { return esc(p.sizeSum || '—'); } }
      ];

      var bodyHtml = rows.map(function (r) {
        return '<tr><th scope="row">' + esc(r.label) + '</th>' + items.map(function (p) { return '<td>' + r.fn(p) + '</td>'; }).join('') + '</tr>';
      }).join('');

      wrap.innerHTML = '<table class="hc-cmp-table"><thead><tr><th scope="col">ویژگی</th>' + headCols + '</tr></thead><tbody>' + bodyHtml + '</tbody></table>';
    }

    /* ---------- مودال مشاهده سریع سایزها و خرید مستقیم ---------- */
    var quickModal = one('[data-hc-quick-modal]');
    var quickBody = one('[data-hc-quick-body]');
    var activeQuickProduct = null;
    var activeQuickSize = '';

    function openQuickModal(id) {
      var p = byId[id];
      if (!p || !quickModal || !quickBody) return;
      activeQuickProduct = p;
      var sizeKeys = Object.keys(p.sizes || {});
      activeQuickSize = (state.size && p.sizes && p.sizes[state.size]) ? state.size : (sizeKeys[0] || '');
      renderQuickModal();
      quickModal.hidden = false;
      document.documentElement.style.overflow = 'hidden';
    }

    function renderQuickModal() {
      var p = activeQuickProduct;
      if (!p || !quickBody) return;
      var szObj = activeQuickSize && p.sizes ? p.sizes[activeQuickSize] : null;
      var canBuy = szObj ? (szObj.inStock && p.purchasable && szObj.vid > 0) : false;
      var priceStr = szObj && szObj.priceText ? szObj.priceText : p.rangeText;
      var pTitle = szObj ? 'قیمت سایز ' + szObj.label : 'محدوده قیمت';

      var sizeBtns = Object.keys(p.sizes || {}).map(function (sk) {
        var s = p.sizes[sk];
        var on = sk === activeQuickSize;
        return '<button type="button" class="hc-qv-size" data-hc-qv-size="' + esc(sk) + '" aria-pressed="' + (on ? 'true' : 'false') + '"' + (s.inStock ? '' : ' disabled') + '>' +
          '<b>' + esc(s.label) + '</b>' +
          '<small>' + esc(s.sub || '') + '</small>' +
          '<span>' + esc(s.inStock ? (s.price ? faNum(s.price) : '') : 'ناموجود') + '</span>' +
          '</button>';
      }).join('');

      var pageHref = p.url + (activeQuickSize && p.sizeKey ? (p.url.indexOf('?') > -1 ? '&' : '?') + 'attribute_' + encodeURIComponent(p.sizeKey) + '=' + encodeURIComponent(activeQuickSize) : '');

      quickBody.innerHTML =
        '<div class="hc-qv-top">' +
          '<div>' +
            '<span class="hc-kicker">' + esc(p.primaryCat ? p.primaryCat.name : 'مشاهده سریع') + '</span>' +
            '<h3>' + esc(p.name) + '</h3>' +
            (p.short ? '<p class="hc-qv-sub">' + esc(p.short) + '</p>' : '') +
          '</div>' +
          '<button type="button" class="hc-modal-close" data-hc-modal-close aria-label="بستن">×</button>' +
        '</div>' +
        '<div class="hc-qv-price"><small>' + esc(pTitle) + '</small><strong>' + esc(priceStr) + '</strong></div>' +
        '<div class="hc-qv-sizes" role="group" aria-label="انتخاب سایز">' + sizeBtns + '</div>' +
        '<form class="hc-qv-foot cart" method="post" enctype="multipart/form-data" action="' + esc(p.url) + '">' +
          '<input type="hidden" name="add-to-cart" value="' + p.id + '">' +
          '<input type="hidden" name="product_id" value="' + p.id + '">' +
          '<input type="hidden" name="variation_id" value="' + (szObj ? szObj.vid : '') + '">' +
          '<input type="hidden" name="attribute_' + esc(p.sizeKey || 'pa_size') + '" value="' + esc(activeQuickSize) + '">' +
          '<div class="hc-qty">' +
            '<button type="button" data-hc-qv-qty="1" aria-label="افزایش">+</button>' +
            '<input type="number" name="quantity" value="' + (p.minQty || 1) + '" min="' + (p.minQty || 1) + '" step="1" aria-label="تعداد" data-hc-qv-qty-input>' +
            '<button type="button" data-hc-qv-qty="-1" aria-label="کاهش">−</button>' +
          '</div>' +
          '<button type="submit" class="hc-btn-gold"' + (canBuy ? '' : ' disabled') + '>افزودن به سبد خرید</button>' +
          '<a class="hc-btn-sec" href="' + esc(pageHref) + '">صفحه کامل محصول</a>' +
        '</form>';
    }

    function closeModals() {
      if (quickModal) quickModal.hidden = true;
      var cmpModal = one('[data-hc-cmp-modal]');
      if (cmpModal) cmpModal.hidden = true;
      if (!sidebar || !sidebar.classList.contains('is-open')) {
        document.documentElement.style.overflow = '';
      }
    }

    /* ---------- رویدادهای کلیک و تغییر ---------- */
    root.addEventListener('click', function (event) {
      var target = event.target.closest ? event.target.closest('button, a, [data-hc-drawer-close], [data-hc-modal-close]') : null;
      if (!target || !root.contains(target)) return;

      if (target.hasAttribute('data-hc-drawer-open')) { setDrawer(true); return; }
      if (target.hasAttribute('data-hc-drawer-close')) { setDrawer(false); return; }
      if (target.hasAttribute('data-hc-modal-close')) { closeModals(); return; }

      if (target.hasAttribute('data-hc-cat')) {
        var nextCat = target.getAttribute('data-hc-cat') || '';
        if (baseCat) {
          state.category = (nextCat === '' || state.category === nextCat) ? baseCat : nextCat;
        } else {
          state.category = (state.category === nextCat && nextCat !== '') ? '' : nextCat;
        }
        render();
        return;
      }
      if (target.hasAttribute('data-hc-size')) {
        var nextSz = target.getAttribute('data-hc-size') || '';
        state.size = state.size === nextSz ? '' : nextSz;
        render();
        return;
      }
      if (target.hasAttribute('data-hc-facet')) {
        var fk = target.getAttribute('data-hc-facet');
        var fv = target.getAttribute('data-value');
        if (state[fk]) { toggleInArray(state[fk], fv); render(); }
        return;
      }
      if (target.hasAttribute('data-hc-extra')) {
        var tx = target.getAttribute('data-hc-extra');
        var tv = target.getAttribute('data-value');
        if (!state.extra[tx]) state.extra[tx] = [];
        toggleInArray(state.extra[tx], tv);
        render();
        return;
      }
      if (target.hasAttribute('data-hc-preset-min')) {
        var pMin = Number(target.getAttribute('data-hc-preset-min')) || 0;
        var pMax = Number(target.getAttribute('data-hc-preset-max')) || 0;
        var effMin = pMin > 0 ? Math.max(boundMin, pMin) : boundMin;
        var effMax = pMax > 0 ? Math.min(boundMax, pMax) : boundMax;
        if (state.minPrice === effMin && state.maxPrice === effMax) {
          state.minPrice = boundMin;
          state.maxPrice = boundMax;
        } else {
          state.minPrice = effMin;
          state.maxPrice = effMax;
        }
        render();
        return;
      }
      if (target.hasAttribute('data-hc-search-clear')) {
        state.search = '';
        render();
        var si = one('[data-hc-search]');
        if (si) si.focus();
        return;
      }
      if (target.hasAttribute('data-hc-price-reset')) {
        state.minPrice = boundMin;
        state.maxPrice = boundMax;
        render();
        return;
      }
      if (target.hasAttribute('data-hc-reset')) { resetAll(); return; }
      if (target.hasAttribute('data-hc-rm-chip')) {
        var chipsWrap = one('[data-hc-active-chips]');
        var cList = chipsWrap && chipsWrap._chips ? chipsWrap._chips : [];
        var chip = cList[Number(target.getAttribute('data-hc-rm-chip'))];
        if (chip) {
          if (chip.type === 'search') state.search = '';
          else if (chip.type === 'category') state.category = baseCat;
          else if (chip.type === 'size') state.size = '';
          else if (chip.type === 'price') { state.minPrice = boundMin; state.maxPrice = boundMax; }
          else if (chip.type === 'stock') state.hideOut = !!init.hideOut;
          else if (chip.type === 'onSale') state.onSale = false;
          else if (chip.type === 'facet') toggleInArray(state[chip.key], chip.value);
          else if (chip.type === 'extra' && state.extra[chip.key]) toggleInArray(state.extra[chip.key], chip.value);
          render();
        }
        return;
      }
      if (target.hasAttribute('data-hc-guide-toggle')) {
        var gBody = one('[data-hc-guide-body]');
        if (gBody) {
          var willOpen = gBody.classList.contains('is-clamped');
          gBody.classList.toggle('is-clamped', !willOpen);
          target.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
          var gl = target.querySelector('span');
          if (gl) gl.textContent = willOpen ? 'بستن توضیحات' : 'مطالعه کامل راهنمای دسته';
        }
        return;
      }
      if (target.hasAttribute('data-hc-view')) {
        state.view = target.getAttribute('data-hc-view') || 'grid';
        render();
        return;
      }
      if (target.hasAttribute('data-hc-cmp')) {
        toggleCompare(Number(target.getAttribute('data-hc-cmp')));
        return;
      }
      if (target.hasAttribute('data-hc-cmp-rm')) {
        toggleCompare(Number(target.getAttribute('data-hc-cmp-rm')));
        return;
      }
      if (target.hasAttribute('data-hc-cmp-clear')) {
        basket = [];
        writeBasket(basket);
        renderCompareUI();
        closeModals();
        return;
      }
      if (target.hasAttribute('data-hc-cmp-open')) {
        var cmpModal = one('[data-hc-cmp-modal]');
        if (cmpModal) {
          cmpSize = state.size || '';
          renderCompareTable();
          cmpModal.hidden = false;
          document.documentElement.style.overflow = 'hidden';
        }
        return;
      }
      if (target.hasAttribute('data-hc-quick')) {
        openQuickModal(Number(target.getAttribute('data-hc-quick')));
        return;
      }
      if (target.hasAttribute('data-hc-qv-size')) {
        activeQuickSize = target.getAttribute('data-hc-qv-size');
        renderQuickModal();
        return;
      }
      if (target.hasAttribute('data-hc-qv-qty') && quickBody) {
        var qIn = quickBody.querySelector('[data-hc-qv-qty-input]');
        if (qIn) {
          var nextQ = Math.max(Number(qIn.min) || 1, (Number(qIn.value) || 1) + Number(target.getAttribute('data-hc-qv-qty')));
          qIn.value = nextQ;
        }
      }
    });

    /* جستجو، اسلایدر قیمت و مرتب‌سازی */
    var searchEl = one('[data-hc-search]');
    if (searchEl) {
      searchEl.addEventListener('input', function () {
        state.search = searchEl.value;
        render();
      });
    }
    var showOutEl = one('[data-hc-showout]');
    if (showOutEl) {
      showOutEl.addEventListener('change', function () { state.hideOut = !showOutEl.checked; render(); });
    }
    var onSaleEl = one('[data-hc-onsale]');
    if (onSaleEl) {
      onSaleEl.addEventListener('change', function () { state.onSale = onSaleEl.checked; render(); });
    }
    var rMinEl = one('[data-hc-price-min]');
    var rMaxEl = one('[data-hc-price-max]');
    if (rMinEl && rMaxEl) {
      rMinEl.addEventListener('input', function () {
        state.minPrice = Math.min(Number(rMinEl.value), state.maxPrice);
        rMinEl.value = state.minPrice;
        render();
      });
      rMaxEl.addEventListener('input', function () {
        state.maxPrice = Math.max(Number(rMaxEl.value), state.minPrice);
        rMaxEl.value = state.maxPrice;
        render();
      });
    }
    var priceResetBtn = one('[data-hc-price-reset]');
    if (priceResetBtn) {
      priceResetBtn.addEventListener('click', function () {
        state.minPrice = boundMin;
        state.maxPrice = boundMax;
        render();
      });
    }
    all('[data-hc-sort]').forEach(function (sel) {
      sel.addEventListener('change', function () { state.sort = sel.value; render(); });
    });
    var cmpSizeSel = one('[data-hc-cmp-size]');
    if (cmpSizeSel) {
      cmpSizeSel.addEventListener('change', function () { cmpSize = cmpSizeSel.value; renderCompareTable(); });
    }

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeModals();
        setDrawer(false);
      }
    });
    window.addEventListener('storage', function (event) {
      if (event.key === CMP_KEY) { basket = readBasket(); renderCompareUI(); }
    });

    /* تشخیص خودکار ارتفاع هدر چسبنده سایت */
    var lastStickyTop = -1;
    var lastDrawerTop = -1;
    var lastMbarH = -1;
    function syncStickyOffset() {
      var adminH = 0;
      var adminBar = document.getElementById('wpadminbar');
      if (adminBar) {
        var ar = adminBar.getBoundingClientRect();
        if (ar.height > 0 && ar.bottom > 0 && window.getComputedStyle(adminBar).position === 'fixed') {
          adminH = ar.bottom;
        }
      }
      var top = adminH;
      var drawerTop = adminH;
      if (data.stickyOffset > 0) {
        top = data.stickyOffset + adminH;
        drawerTop = top;
      } else {
        var minW = window.innerWidth * 0.5;
        var nodes = document.querySelectorAll('header, [role="banner"], [data-elementor-type="header"], .elementor-location-header, .elementor-sticky, .elementor-sticky--active, .site-header, #masthead');
        for (var i = 0; i < nodes.length; i++) {
          var el = nodes[i];
          if (root.contains(el) || el.id === 'wpadminbar' || el.classList.contains('elementor-sticky__spacer')) continue;
          var cs = window.getComputedStyle(el);
          if (cs.display === 'none' || cs.visibility === 'hidden' || parseFloat(cs.opacity) === 0) continue;
          var r = el.getBoundingClientRect();
          if (r.height < 24 || r.height > 220 || r.width < minW || r.top < -4 || r.top > 90) continue;
          if (r.bottom > drawerTop) drawerTop = r.bottom;
          var isFixed = cs.position === 'fixed' || cs.position === 'sticky' || el.classList.contains('elementor-sticky--active');
          if (isFixed && r.bottom > top) {
            top = r.bottom;
          }
        }
      }
      var px = Math.max(0, Math.floor(top));
      if (px !== lastStickyTop) {
        lastStickyTop = px;
        root.style.setProperty('--hc-sticky-top', px + 'px');
      }
      var dpx = Math.max(px, Math.floor(drawerTop));
      if (dpx !== lastDrawerTop) {
        lastDrawerTop = dpx;
        root.style.setProperty('--hc-drawer-top', dpx + 'px');
      }
      var mbar = root.querySelector('.hc-mobile-bar');
      var mh = mbar && mbar.offsetParent !== null ? Math.ceil(mbar.getBoundingClientRect().height) : 0;
      if (mh !== lastMbarH) {
        lastMbarH = mh;
        root.style.setProperty('--hc-mbar-h', mh + 'px');
      }
    }
    syncStickyOffset();
    window.addEventListener('scroll', syncStickyOffset, { passive: true });
    window.addEventListener('resize', syncStickyOffset);
    window.addEventListener('load', syncStickyOffset);

    /* حالت تمام‌عرض حتی داخل ستون محدود المنتور */
    if (root.getAttribute('data-hc-fw') === 'yes') {
      var fit = function () {
        root.style.position = 'relative';
        root.style.maxWidth = 'none';
        root.style.left = '0px';
        root.style.width = document.documentElement.clientWidth + 'px';
        root.style.left = -root.getBoundingClientRect().left + 'px';
      };
      fit();
      window.addEventListener('resize', fit);
      window.addEventListener('load', fit);
      window.setTimeout(fit, 600);
    }

    render();
    renderCompareUI();
  }

  function init() {
    addFonts();
    Array.prototype.forEach.call(document.querySelectorAll('.higer-cat'), mount);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
</script>
<?php
		return (string) ob_get_clean();
	}
}

if ( ! function_exists( 'higer_cat_context' ) ) {
	/** زمینه فعلی صفحه (فروشگاه کل، آرشیو دسته‌بندی، آرشیو ویژگی یا جستجو) را تشخیص می‌دهد. */
	function higer_cat_context( $atts, $cfg ) {
		$ctx = array(
			'is_category'  => false,
			'term_id'      => 0,
			'cat_name'     => '',
			'shop_url'     => '',
			'theme'        => 'default',
			'title'        => $cfg['hero']['title'],
			'title_accent' => '',
			'title_after'  => '',
			'subtitle'     => $cfg['hero']['subtitle'],
			'kicker'       => $cfg['hero']['kicker'],
			'core_key'     => 'bonnell',
			'highlights'   => array(),
			'art_label'    => '',
			'thumb_url'    => '',
			'show_finder'  => true,
			'finder_text'  => '',
			'long_desc'    => '',
			'crumbs'       => array(),
			'category'     => '',
			'size'         => '',
			'firmness'     => array(),
			'layer'        => array(),
			'warranty'     => array(),
			'spring'       => array(),
			'special'      => array(),
			'fabric'       => array(),
			'search'       => '',
		);

		$shop_url        = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
		$ctx['shop_url'] = $shop_url;
		$qobj            = function_exists( 'get_queried_object' ) ? get_queried_object() : null;

		if ( ! empty( $atts['category'] ) ) {
			$ctx['category'] = sanitize_title( (string) $atts['category'] );
			$term            = function_exists( 'get_term_by' ) ? get_term_by( 'slug', $ctx['category'], 'product_cat' ) : null;
			if ( $term && ! is_wp_error( $term ) ) {
				$qobj = $term;
			}
		}

		if ( is_object( $qobj ) && ! empty( $qobj->taxonomy ) ) {
			if ( 'product_cat' === $qobj->taxonomy ) {
				$slug               = (string) $qobj->slug;
				$heroes             = isset( $cfg['category_heroes'] ) && is_array( $cfg['category_heroes'] ) ? $cfg['category_heroes'] : array();
				$ch                 = isset( $heroes[ $slug ] ) && is_array( $heroes[ $slug ] ) ? $heroes[ $slug ] : null;
				$ctx['is_category'] = true;
				$ctx['term_id']     = (int) $qobj->term_id;
				$ctx['category']    = $slug;
				$ctx['cat_name']    = (string) $qobj->name;
				$ctx['title']       = (string) $qobj->name;
				$ctx['kicker']      = 'دسته‌بندی محصولات';

				/* تصویر شاخص دسته‌بندی (در صورت ثبت در ووکامرس) */
				if ( function_exists( 'get_term_meta' ) && function_exists( 'wp_get_attachment_image_url' ) ) {
					$thumb_id = (int) get_term_meta( (int) $qobj->term_id, 'thumbnail_id', true );
					if ( $thumb_id > 0 ) {
						$turl = wp_get_attachment_image_url( $thumb_id, 'large' );
						if ( $turl ) {
							$ctx['thumb_url'] = (string) $turl;
						}
					}
				}

				/* سلسله‌مراتب والدها + ارث‌بری طرح و تم برای دسته‌های جدید آینده */
				$ctx['crumbs'][] = array( 'name' => 'فروشگاه', 'url' => $shop_url );
				$parent_name     = '';
				$anc_theme       = '';
				$anc_core        = '';
				foreach ( array_reverse( (array) get_ancestors( $qobj->term_id, 'product_cat', 'taxonomy' ) ) as $aid ) {
					$anc = get_term( $aid, 'product_cat' );
					if ( $anc && ! is_wp_error( $anc ) ) {
						$ctx['crumbs'][] = array( 'name' => $anc->name, 'url' => higer_cat_term_url( $anc, 'product_cat' ) );
						$parent_name     = (string) $anc->name;
						if ( isset( $cfg['cores'][ $anc->slug ]['key'] ) ) {
							$anc_core = $cfg['cores'][ $anc->slug ]['key'];
						}
						if ( isset( $heroes[ $anc->slug ]['theme'] ) ) {
							$anc_theme = $heroes[ $anc->slug ]['theme'];
						}
					}
				}
				$ctx['crumbs'][] = array( 'name' => $qobj->name, 'url' => '' );

				if ( isset( $cfg['cores'][ $slug ]['key'] ) ) {
					$ctx['core_key'] = $cfg['cores'][ $slug ]['key'];
				} elseif ( '' !== $anc_core ) {
					$ctx['core_key'] = $anc_core;
				}
				$ctx['theme'] = $ch && ! empty( $ch['theme'] ) ? (string) $ch['theme'] : ( '' !== $anc_theme ? $anc_theme : $ctx['core_key'] );

				if ( $ch ) {
					if ( ! empty( $ch['kicker'] ) ) {
						$ctx['kicker'] = (string) $ch['kicker'];
					}
					if ( isset( $ch['title'] ) && '' !== $ch['title'] ) {
						$ctx['title']        = (string) $ch['title'];
						$ctx['title_accent'] = isset( $ch['accent'] ) ? (string) $ch['accent'] : '';
						$ctx['title_after']  = isset( $ch['title_after'] ) ? (string) $ch['title_after'] : '';
					}
					if ( ! empty( $ch['subtitle'] ) ) {
						$ctx['subtitle'] = (string) $ch['subtitle'];
					}
					if ( ! empty( $ch['highlights'] ) && is_array( $ch['highlights'] ) ) {
						$ctx['highlights'] = array_values( array_filter( $ch['highlights'] ) );
					}
					if ( ! empty( $ch['art_label'] ) ) {
						$ctx['art_label'] = (string) $ch['art_label'];
					}
					if ( isset( $ch['show_finder'] ) ) {
						$ctx['show_finder'] = (bool) $ch['show_finder'];
					}
					if ( ! empty( $ch['finder_text'] ) ) {
						$ctx['finder_text'] = (string) $ch['finder_text'];
					}
				} else {
					if ( '' !== $parent_name ) {
						$ctx['kicker'] = 'زیرمجموعه ' . $parent_name;
					}
					$ctx['art_label'] = 'دسته‌بندی ' . $qobj->name;
					if ( isset( $cfg['cores'][ $slug ]['text'] ) ) {
						$ctx['subtitle'] = $cfg['cores'][ $slug ]['text'];
					} else {
						$ctx['subtitle'] = 'مشاهده و مقایسه مدل‌های دسته‌بندی ' . $qobj->name . ' هیگر همراه با قیمت به‌روز هر سایز.';
					}
				}

				/* توضیحات ثبت‌شده در ووکامرس: کوتاه = داخل هیرو، بلند/سئو = بخش بازشوی پایین صفحه */
				$raw_desc   = trim( (string) $qobj->description );
				$plain_desc = trim( preg_replace( '/s+/u', ' ', wp_strip_all_tags( $raw_desc ) ) );
				if ( '' !== $plain_desc ) {
					$plain_len = function_exists( 'mb_strlen' ) ? mb_strlen( $plain_desc, 'UTF-8' ) : strlen( $plain_desc );
					$has_rich  = (bool) preg_match( '/<(h[1-6]|ul|ol|table|blockquote)/i', $raw_desc );
					if ( $plain_len > 260 || $has_rich ) {
						$formatted        = function_exists( 'wpautop' ) ? wpautop( $raw_desc ) : $raw_desc;
						$ctx['long_desc'] = function_exists( 'wp_kses_post' ) ? wp_kses_post( $formatted ) : $formatted;
					} else {
						$ctx['subtitle'] = $plain_desc;
					}
				}
			} else {
				$keys = $cfg['attributes'];
				$ctx['title']  = (string) $qobj->name;
				$ctx['kicker'] = function_exists( 'wc_attribute_label' ) ? wc_attribute_label( $qobj->taxonomy ) : 'فیلتر ویژگی';
				$ctx['crumbs'][] = array( 'name' => 'فروشگاه', 'url' => $shop_url );
				$ctx['crumbs'][] = array( 'name' => $qobj->name, 'url' => '' );
				if ( $qobj->taxonomy === $keys['size'] ) {
					$ctx['size'] = (string) $qobj->slug;
				} elseif ( $qobj->taxonomy === $keys['firmness'] ) {
					$ctx['firmness'] = array( (string) $qobj->slug );
				} elseif ( $qobj->taxonomy === $keys['layer'] ) {
					$ctx['layer'] = array( (string) $qobj->slug );
				} elseif ( $qobj->taxonomy === $keys['warranty'] ) {
					$ctx['warranty'] = array( (string) $qobj->slug );
				} elseif ( $qobj->taxonomy === $keys['spring'] ) {
					$ctx['spring'] = array( (string) $qobj->slug );
				} elseif ( $qobj->taxonomy === $keys['special'] ) {
					$ctx['special'] = array( (string) $qobj->slug );
				} elseif ( $qobj->taxonomy === $keys['fabric'] ) {
					$ctx['fabric'] = array( (string) $qobj->slug );
				}
			}
		}

		$sq = function_exists( 'get_search_query' ) ? trim( (string) get_search_query( false ) ) : '';
		if ( '' === $sq && isset( $_GET['s'] ) ) { // phpcs:ignore
			$sq = trim( sanitize_text_field( wp_unslash( (string) $_GET['s'] ) ) ); // phpcs:ignore
		}
		if ( '' !== $sq ) {
			$ctx['search'] = $sq;
			if ( empty( $ctx['crumbs'] ) ) {
				$ctx['kicker']   = 'جستجو در فروشگاه';
				$ctx['title']    = 'نتایج جستجو برای «' . $sq . '»';
				$ctx['crumbs'][] = array( 'name' => 'فروشگاه', 'url' => $shop_url );
				$ctx['crumbs'][] = array( 'name' => 'جستجو: ' . $sq, 'url' => '' );
			}
		}

		if ( empty( $ctx['crumbs'] ) ) {
			$ctx['crumbs'][] = array( 'name' => 'فروشگاه', 'url' => '' );
		}
		return $ctx;
	}
}

if ( ! function_exists( 'higer_cat_render' ) ) {
	function higer_cat_render( $atts = array() ) {
		static $instance = 0;
		if ( ! function_exists( 'wc_get_products' ) ) {
			return '';
		}
		$instance++;
		$atts    = shortcode_atts( array( 'category' => '', 'fullwidth' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_category' );
		$cfg     = higer_cat_config();
		$catalog = higer_cat_catalog( $cfg );
		$ctx     = higer_cat_context( $atts, $cfg );
		$store   = $cfg['store'];
		$fa      = 'higer_cat_fa';
		$uid     = 'hc-' . $instance;

		$is_cat_page  = ! empty( $ctx['is_category'] ) && '' !== $ctx['category'];
		$scoped       = $is_cat_page ? higer_cat_scope_catalog( $catalog, $ctx['category'], $cfg ) : null;
		$products     = $is_cat_page ? $scoped['products'] : $catalog['products'];
		$categories   = $is_cat_page ? $scoped['subCats'] : $catalog['categories'];
		$siblings     = $is_cat_page ? $scoped['siblings'] : array();
		$parent_cat   = $is_cat_page ? $scoped['parentCat'] : null;
		$cat_stats    = $is_cat_page ? $scoped['stats'] : array();
		$facets       = $is_cat_page ? $scoped['facets'] : $catalog['facets'];
		$min_price    = $is_cat_page ? $scoped['minPrice'] : $catalog['minPrice'];
		$max_price    = $is_cat_page ? $scoped['maxPrice'] : $catalog['maxPrice'];
		$has_sale     = $is_cat_page ? $scoped['hasSale'] : $catalog['hasSale'];
		$presets      = $is_cat_page ? $scoped['presets'] : (array) $cfg['price_presets'];
		$has_firmness = $is_cat_page ? $scoped['hasFirmness'] : ! empty( $facets['firmness'] );
		$has_warranty = $is_cat_page ? $scoped['hasWarranty'] : ! empty( $facets['warranty'] );
		$show_finder  = ! empty( $cfg['finder_path'] ) && ( ! $is_cat_page || ! empty( $ctx['show_finder'] ) );
		$hide_out     = ! empty( $cfg['hide_out_of_stock'] );
		$initial_vis  = $is_cat_page ? ( $hide_out ? (int) $scoped['inStockCount'] : (int) $scoped['totalCount'] ) : count( $products );
		$total_fa     = $fa( count( $products ) );
		$vis_fa       = $fa( $initial_vis );
		$cat_cnt = function ( $cat_arr ) use ( $hide_out ) {
			return ( $hide_out && isset( $cat_arr['inStockCount'] ) ) ? (int) $cat_arr['inStockCount'] : (int) $cat_arr['count'];
		};
		$all_shop_num = count( $catalog['products'] );
		if ( $hide_out ) {
			$all_shop_num = 0;
			foreach ( $catalog['products'] as $cp ) {
				if ( ! empty( $cp['inStock'] ) ) {
					$all_shop_num++;
				}
			}
		}
		$all_shop_fa  = $fa( $all_shop_num );
		$scale_max    = higer_cat_firmness_max( $cfg['attributes']['firmness'] );

		/* پیام‌های سبد خرید ووکامرس */
		$wc      = function_exists( 'WC' ) ? WC() : null;
		$notices = ( $wc && ! empty( $wc->session ) && function_exists( 'wc_print_notices' ) ) ? (string) wc_print_notices( true ) : '';

		/* داده ارسالی به جاوااسکریپت برای فیلتر، مرتب‌سازی، قیمت سایز و مقایسه */
		$hero_cores = array();
		foreach ( $cfg['cores'] as $cslug => $cinfo ) {
			$hero_cores[ $cslug ] = array(
				'title' => $cinfo['title'],
				'text'  => $cinfo['text'],
				'svg'   => higer_cat_core_svg( $cinfo['key'] ),
			);
		}
		$payload = array(
			'stickyOffset' => isset( $cfg['sticky_offset'] ) ? max( 0, (int) $cfg['sticky_offset'] ) : 0,
			'heroDefault'  => array(
				'kicker'   => $cfg['hero']['kicker'],
				'title'    => $cfg['hero']['title'],
				'subtitle' => $cfg['hero']['subtitle'],
				'svg'      => higer_cat_core_svg( 'bonnell' ),
			),
			'heroCores'    => $hero_cores,
			'minPrice'     => $min_price,
			'maxPrice'     => $max_price,
			'hasSale'      => $has_sale,
			'presets'      => $presets,
			'categories'   => $categories,
			'facets'       => $facets,
			'comparePool'  => $is_cat_page ? $catalog['products'] : array(),
			'initial'      => array(
				'baseCategory' => $is_cat_page ? $ctx['category'] : '',
				'category'     => $ctx['category'],
				'size'     => $ctx['size'],
				'firmness' => $ctx['firmness'],
				'layer'    => $ctx['layer'],
				'warranty' => $ctx['warranty'],
				'spring'   => $ctx['spring'],
				'special'  => $ctx['special'],
				'fabric'   => $ctx['fabric'],
				'search'   => $ctx['search'],
				'hideOut'  => ! empty( $cfg['hide_out_of_stock'] ),
			),
			'products'     => $products,
		);

		ob_start();
		echo higer_cat_assets(); // phpcs:ignore
		?>
<div class="higer-cat" id="<?php echo esc_attr( $uid ); ?>" dir="rtl" lang="fa" data-hc-fw="<?php echo 'no' === strtolower( (string) $atts['fullwidth'] ) ? 'no' : 'yes'; ?>">
	<script type="application/json" data-hc-data><?php echo wp_json_encode( $payload, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?></script>
	<?php if ( '' !== trim( $notices ) ) : ?><div class="hc-wrap hc-notices"><?php echo $notices; // phpcs:ignore ?></div><?php endif; ?>

	<!-- ===== سربرگ صفحه (اختصاصی دسته‌بندی یا اصلی فروشگاه) ===== -->
	<?php
	$hero_cls = 'hc-hero';
	if ( $is_cat_page ) {
		$hero_cls .= ' is-category is-theme-' . sanitize_html_class( $ctx['theme'] );
	}
	?>
	<header class="<?php echo esc_attr( $hero_cls ); ?>"<?php echo $is_cat_page ? ' data-hc-cat-hero="' . esc_attr( $ctx['category'] ) . '"' : ''; ?>>
		<nav class="hc-crumbs" aria-label="مسیر صفحه">
			<div class="hc-wrap hc-crumbs-row">
				<ol>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a></li>
					<?php foreach ( $ctx['crumbs'] as $crumb ) : ?>
					<li<?php echo '' === $crumb['url'] ? ' aria-current="page"' : ''; ?>><?php if ( '' !== $crumb['url'] ) : ?><a href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['name'] ); ?></a><?php else : echo esc_html( $crumb['name'] ); endif; ?></li>
					<?php endforeach; ?>
				</ol>
				<?php if ( $is_cat_page && '' !== $ctx['shop_url'] ) : ?>
				<a class="hc-back-shop" href="<?php echo esc_url( $ctx['shop_url'] ); ?>">همه محصولات فروشگاه <?php echo higer_cat_icon( 'chevron-left', 13 ); // phpcs:ignore ?></a>
				<?php endif; ?>
			</div>
		</nav>

		<?php if ( $is_cat_page ) : ?>
		<div class="hc-wrap hc-hero-grid">
			<div class="hc-hero-copy">
				<span class="hc-kicker is-dark"><?php echo higer_cat_icon( 'layers', 13 ); // phpcs:ignore ?> <span data-hc-hero-kicker><?php echo esc_html( $ctx['kicker'] ); ?></span> • <b data-hc-total-badge><?php echo esc_html( $vis_fa ); ?> مدل</b></span>
				<h1 class="hc-hero-title" data-hc-hero-title><?php
					echo esc_html( $ctx['title'] );
					if ( '' !== $ctx['title_accent'] ) {
						echo ' <span class="hc-gold-text">' . esc_html( $ctx['title_accent'] ) . '</span>';
					}
					if ( '' !== $ctx['title_after'] ) {
						echo ' ' . esc_html( $ctx['title_after'] );
					}
				?></h1>
				<p class="hc-hero-sub" data-hc-hero-sub><?php echo esc_html( $ctx['subtitle'] ); ?></p>

				<?php if ( ! empty( $ctx['highlights'] ) ) : ?>
				<ul class="hc-cat-traits" aria-label="ویژگی‌های این دسته‌بندی">
					<?php foreach ( $ctx['highlights'] as $hl ) : ?>
					<li><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $hl ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( ! empty( $cat_stats ) ) : ?>
				<div class="hc-cat-stats" aria-label="خلاصه این دسته‌بندی">
					<?php foreach ( $cat_stats as $st ) : ?>
					<div class="hc-cat-stat">
						<small><?php echo esc_html( $st['label'] ); ?></small>
						<b<?php echo '' !== $st['attr'] ? ' ' . $st['attr'] : ''; // phpcs:ignore ?>><?php echo esc_html( $st['value'] ); ?></b>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<div class="hc-hero-art is-cat" data-hc-hero-art>
				<div class="hc-cat-art-stage<?php echo '' !== $ctx['thumb_url'] ? ' has-img' : ''; ?>">
					<?php if ( '' !== $ctx['thumb_url'] ) : ?>
					<img src="<?php echo esc_url( $ctx['thumb_url'] ); ?>" alt="<?php echo esc_attr( $ctx['cat_name'] ); ?>" decoding="async">
					<?php else : ?>
					<?php echo higer_cat_core_svg( $ctx['core_key'] ); // phpcs:ignore ?>
					<?php endif; ?>
				</div>
				<?php if ( '' !== $ctx['art_label'] ) : ?>
				<div class="hc-cat-art-cap">
					<span><?php echo esc_html( $ctx['art_label'] ); ?></span>
					<?php echo higer_cat_icon( 'bed', 15 ); // phpcs:ignore ?>
				</div>
				<?php endif; ?>
				<?php if ( $show_finder ) : ?>
				<a class="hc-cat-finder-mini" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
					<span><?php echo higer_cat_icon( 'sparkles', 14 ); // phpcs:ignore ?> تشک‌سنج هوشمند هیگر</span>
					<?php echo higer_cat_icon( 'chevron-left', 14 ); // phpcs:ignore ?>
				</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( ! empty( $categories ) ) : ?>
		<div class="hc-wrap">
			<div class="hc-cat-nav-row" role="tablist" aria-label="زیرمجموعه‌های <?php echo esc_attr( $ctx['cat_name'] ); ?>">
				<span class="hc-cat-strip-label">زیرمجموعه‌ها:</span>
				<button type="button" class="hc-cat-pill" data-hc-cat="<?php echo esc_attr( $ctx['category'] ); ?>" aria-pressed="true">
					<b>همه <?php echo esc_html( $ctx['cat_name'] ); ?></b>
					<span data-hc-cat-pill-count="<?php echo esc_attr( $ctx['category'] ); ?>"><?php echo esc_html( $vis_fa ); ?></span>
				</button>
				<?php foreach ( $categories as $sub ) : ?>
				<button type="button" class="hc-cat-pill<?php echo $sub['depth'] > 0 ? ' is-sub' : ''; ?>" data-hc-cat="<?php echo esc_attr( $sub['slug'] ); ?>" aria-pressed="false">
					<b><?php echo esc_html( $sub['name'] ); ?></b>
					<span data-hc-cat-pill-count="<?php echo esc_attr( $sub['slug'] ); ?>"><?php echo esc_html( $fa( $sub['count'] ) ); ?></span>
				</button>
				<?php endforeach; ?>
			</div>
		</div>
		<?php elseif ( count( $siblings ) > 1 || $parent_cat ) : ?>
		<nav class="hc-wrap" aria-label="سایر دسته‌بندی‌های مرتبط">
			<div class="hc-cat-nav-row">
				<span class="hc-cat-strip-label"><?php echo $parent_cat ? esc_html( 'دسته‌های ' . $parent_cat['name'] . ':' ) : 'سایر دسته‌ها:'; ?></span>
				<?php if ( $parent_cat && '' !== $parent_cat['url'] ) : ?>
				<a class="hc-cat-pill is-ghost" href="<?php echo esc_url( $parent_cat['url'] ); ?>"><b>همه <?php echo esc_html( $parent_cat['name'] ); ?></b><span><?php echo esc_html( $fa( $cat_cnt( $parent_cat ) ) ); ?></span></a>
				<?php endif; ?>
				<?php foreach ( $siblings as $sib ) :
					$is_cur = $sib['slug'] === $ctx['category'];
					?>
				<a class="hc-cat-pill<?php echo $is_cur ? ' is-active' : ''; ?>" href="<?php echo esc_url( $sib['url'] ); ?>"<?php echo $is_cur ? ' aria-current="page"' : ''; ?>>
					<b><?php echo esc_html( $sib['name'] ); ?></b>
					<span><?php echo esc_html( $is_cur ? $vis_fa : $fa( $cat_cnt( $sib ) ) ); ?></span>
				</a>
				<?php endforeach; ?>
				<?php if ( '' !== $ctx['shop_url'] ) : ?>
				<a class="hc-cat-pill is-ghost" href="<?php echo esc_url( $ctx['shop_url'] ); ?>"><b>کل فروشگاه</b><span><?php echo esc_html( $all_shop_fa ); ?></span></a>
				<?php endif; ?>
			</div>
		</nav>
		<?php endif; ?>

		<?php else : ?>
		<div class="hc-wrap hc-hero-grid">
			<div class="hc-hero-copy">
				<span class="hc-kicker is-dark"><?php echo higer_cat_icon( 'layers', 13 ); // phpcs:ignore ?> <span data-hc-hero-kicker><?php echo esc_html( $ctx['kicker'] ); ?></span> • <b data-hc-total-badge><?php echo esc_html( $total_fa ); ?> محصول</b></span>
				<h1 class="hc-hero-title" data-hc-hero-title><?php echo esc_html( $ctx['title'] ); ?></h1>
				<p class="hc-hero-sub" data-hc-hero-sub><?php echo esc_html( $ctx['subtitle'] ); ?></p>
			<?php if ( $show_finder ) : ?>
			<a class="hc-hero-finder" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
				<span class="hc-finder-ico" aria-hidden="true"><?php echo higer_cat_icon( 'sparkles', 20 ); // phpcs:ignore ?></span>
				<span class="hc-finder-copy">
					<b>تشک‌سنج هوشمند هیگر</b>
					<small>نمی‌دانید کدام مدل مناسب شماست؟ با چند سؤال بررسی کنید</small>
				</span>
				<span class="hc-finder-go">شروع <?php echo higer_cat_icon( 'chevron-left', 14 ); // phpcs:ignore ?></span>
			</a>
			<?php endif; ?>
			</div>
			<div class="hc-hero-art" aria-hidden="true" data-hc-hero-art>
				<?php echo higer_cat_core_svg( $ctx['core_key'] ); // phpcs:ignore ?>
			</div>
		</div>
		<?php if ( $categories ) : ?>
		<div class="hc-wrap hc-cat-strip-wrap">
			<div class="hc-cat-strip" role="tablist" aria-label="دسته‌بندی سریع محصولات">
				<button type="button" class="hc-cat-pill" data-hc-cat="" aria-pressed="<?php echo '' === $ctx['category'] ? 'true' : 'false'; ?>">
					<b>همه محصولات</b>
					<span data-hc-cat-pill-count=""><?php echo esc_html( $total_fa ); ?></span>
				</button>
				<?php foreach ( $categories as $cat ) : ?>
				<button type="button" class="hc-cat-pill<?php echo $cat['depth'] > 0 ? ' is-sub' : ''; ?>" data-hc-cat="<?php echo esc_attr( $cat['slug'] ); ?>" aria-pressed="<?php echo $cat['slug'] === $ctx['category'] ? 'true' : 'false'; ?>">
					<b><?php echo esc_html( $cat['name'] ); ?></b>
					<span data-hc-cat-pill-count="<?php echo esc_attr( $cat['slug'] ); ?>"><?php echo esc_html( $fa( $cat['count'] ) ); ?></span>
				</button>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	</header>

	<!-- ===== نوار ابزار چسبنده موبایل ===== -->
	<div class="hc-mobile-bar" data-hc-mobile-bar>
		<div class="hc-wrap hc-mobile-bar-inner">
			<button type="button" class="hc-mobile-filter-btn" data-hc-drawer-open aria-expanded="false" aria-controls="<?php echo esc_attr( $uid ); ?>-sidebar">
				<?php echo higer_cat_icon( 'sliders', 16 ); // phpcs:ignore ?>
				<span>فیلترها</span>
				<b class="hc-badge" data-hc-active-count hidden>۰</b>
			</button>
			<label class="hc-mobile-sort">
				<span class="hc-sr">مرتب‌سازی</span>
				<select data-hc-sort>
					<option value="default">مرتب‌سازی: پیش‌فرض</option>
					<option value="price-asc">ارزان‌ترین</option>
					<option value="price-desc">گران‌ترین</option>
					<?php if ( $has_warranty ) : ?><option value="warranty-desc">بیشترین گارانتی</option><?php endif; ?>
					<?php if ( $has_firmness ) : ?>
					<option value="firm-asc">نرم‌ترین به سفت‌ترین</option>
					<option value="firm-desc">سفت‌ترین به نرم‌ترین</option>
					<?php endif; ?>
					<option value="name-asc">حروف الفبا</option>
				</select>
			</label>
		</div>
	</div>

	<!-- ===== بدنه اصلی: ستون فیلترها + شبکه محصولات ===== -->
	<section class="hc-main">
		<div class="hc-wrap hc-layout">

			<!-- پس‌زمینه تیره دراور موبایل -->
			<div class="hc-backdrop" data-hc-drawer-close hidden></div>

			<!-- ===== سایدبار تمام فیلترها ===== -->
			<aside class="hc-sidebar" id="<?php echo esc_attr( $uid ); ?>-sidebar" data-hc-sidebar aria-label="فیلترهای محصولات">
				<div class="hc-sidebar-head">
					<div class="hc-sidebar-title">
						<?php echo higer_cat_icon( 'sliders', 17 ); // phpcs:ignore ?>
						<h2>فیلتر محصولات</h2>
						<span class="hc-badge" data-hc-active-count hidden>۰</span>
						<button type="button" class="hc-drawer-close" data-hc-drawer-close aria-label="بستن فیلترها"><?php echo higer_cat_icon( 'close', 18 ); // phpcs:ignore ?></button>
					</div>
					<div class="hc-active-chips" data-hc-active-chips></div>
					<button type="button" class="hc-reset-link" data-hc-reset hidden><?php echo higer_cat_icon( 'reset', 13 ); // phpcs:ignore ?> پاک کردن همه فیلترها</button>
				</div>

				<div class="hc-sidebar-body">
					<!-- ۱. جستجوی آنی -->
					<div class="hc-fgroup hc-fgroup-plain">
						<label class="hc-search" for="<?php echo esc_attr( $uid ); ?>-q">
							<?php echo higer_cat_icon( 'search', 16 ); // phpcs:ignore ?>
							<input id="<?php echo esc_attr( $uid ); ?>-q" type="search" placeholder="جستجو: هلسا، رکسانا، مموری فوم..." value="<?php echo esc_attr( $ctx['search'] ); ?>" autocomplete="off" data-hc-search>
							<button type="button" class="hc-search-clear" data-hc-search-clear aria-label="پاک کردن جستجو"<?php echo '' === $ctx['search'] ? ' hidden' : ''; ?>><?php echo higer_cat_icon( 'close', 14 ); // phpcs:ignore ?></button>
						</label>
						<div class="hc-toggles">
							<?php if ( ! empty( $cfg['show_out_of_stock'] ) ) : ?>
							<label class="hc-switch">
								<input type="checkbox" data-hc-showout<?php echo empty( $cfg['hide_out_of_stock'] ) ? ' checked' : ''; ?>>
								<span class="hc-switch-ui" aria-hidden="true"></span>
								<span>نمایش کالاهای ناموجود</span>
							</label>
							<?php endif; ?>
							<?php if ( $has_sale ) : ?>
							<label class="hc-switch">
								<input type="checkbox" data-hc-onsale>
								<span class="hc-switch-ui" aria-hidden="true"></span>
								<span>فقط تخفیف‌دارها</span>
							</label>
							<?php endif; ?>
						</div>
					</div>

					<!-- ۲. انتخاب سایز تخت (نمایش قیمت دقیق همان سایز) -->
					<?php if ( ! empty( $facets['sizes'] ) ) : ?>
					<details class="hc-fgroup" open>
						<summary><span><?php echo higer_cat_icon( 'ruler', 15 ); // phpcs:ignore ?> سایز تخت <small class="hc-fhint">(نمایش قیمت سایز)</small></span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody">
							<div class="hc-size-grid">
								<?php foreach ( $facets['sizes'] as $sz ) : ?>
								<button type="button" class="hc-size-chip" data-hc-size="<?php echo esc_attr( $sz['slug'] ); ?>" aria-pressed="<?php echo $sz['slug'] === $ctx['size'] ? 'true' : 'false'; ?>">
									<b><?php echo esc_html( $sz['label'] ); ?></b>
									<?php if ( '' !== $sz['sub'] ) : ?><small><?php echo esc_html( $sz['sub'] ); ?></small><?php endif; ?>
									<em data-hc-count="size:<?php echo esc_attr( $sz['slug'] ); ?>"></em>
								</button>
								<?php endforeach; ?>
							</div>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۳. محدوده قیمت -->
					<?php if ( $max_price > 0 && $max_price > $min_price ) : ?>
					<details class="hc-fgroup" open>
						<summary><span>محدوده قیمت (تومان)</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody">
							<div class="hc-price-readout">
								<span>از <b data-hc-price-min-out><?php echo esc_html( higer_cat_number( $min_price ) ); ?></b></span>
								<span>تا <b data-hc-price-max-out><?php echo esc_html( higer_cat_number( $max_price ) ); ?></b></span>
							</div>
							<div class="hc-range-dual" data-hc-range-wrap>
								<div class="hc-range-track"><span data-hc-range-fill></span></div>
								<input type="range" min="<?php echo esc_attr( (string) (int) $min_price ); ?>" max="<?php echo esc_attr( (string) (int) $max_price ); ?>" step="500000" value="<?php echo esc_attr( (string) (int) $min_price ); ?>" aria-label="حداقل قیمت" data-hc-price-min>
								<input type="range" min="<?php echo esc_attr( (string) (int) $min_price ); ?>" max="<?php echo esc_attr( (string) (int) $max_price ); ?>" step="500000" value="<?php echo esc_attr( (string) (int) $max_price ); ?>" aria-label="حداکثر قیمت" data-hc-price-max>
							</div>
							<button type="button" class="hc-price-reset" data-hc-price-reset hidden><?php echo higer_cat_icon( 'reset', 12 ); // phpcs:ignore ?> بازنشانی محدوده قیمت</button>
							<?php if ( ! empty( $presets ) ) : ?>
							<div class="hc-presets">
								<?php foreach ( $presets as $pr ) : ?>
								<button type="button" class="hc-preset" data-hc-preset-min="<?php echo (int) $pr['min']; ?>" data-hc-preset-max="<?php echo (int) $pr['max']; ?>"><?php echo esc_html( $pr['label'] ); ?></button>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۴. دسته‌بندی و نوع هسته -->
					<?php if ( $is_cat_page ) : ?>
						<?php if ( ! empty( $categories ) ) : ?>
						<details class="hc-fgroup" open>
							<summary><span><?php echo higer_cat_icon( 'bed', 15 ); // phpcs:ignore ?> زیرمجموعه‌های <?php echo esc_html( $ctx['cat_name'] ); ?></span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
							<div class="hc-fbody">
								<ul class="hc-cat-tree">
									<li>
										<button type="button" class="hc-cat-row" data-hc-cat="<?php echo esc_attr( $ctx['category'] ); ?>" aria-pressed="true">
											<span class="hc-radio" aria-hidden="true"></span>
											<span class="hc-cat-name">همه <?php echo esc_html( $ctx['cat_name'] ); ?></span>
											<em class="hc-fcount" data-hc-count="cat:<?php echo esc_attr( $ctx['category'] ); ?>"><?php echo esc_html( $vis_fa ); ?></em>
										</button>
									</li>
									<?php foreach ( $categories as $cat ) : ?>
									<li style="--depth:<?php echo (int) $cat['depth']; ?>">
										<button type="button" class="hc-cat-row" data-hc-cat="<?php echo esc_attr( $cat['slug'] ); ?>" aria-pressed="false">
											<span class="hc-radio" aria-hidden="true"></span>
											<span class="hc-cat-name"><?php echo esc_html( $cat['name'] ); ?></span>
											<em class="hc-fcount" data-hc-count="cat:<?php echo esc_attr( $cat['slug'] ); ?>"><?php echo esc_html( $fa( $cat['count'] ) ); ?></em>
										</button>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php if ( '' !== $ctx['shop_url'] ) : ?>
								<a class="hc-cat-all-link" href="<?php echo esc_url( $ctx['shop_url'] ); ?>"><span>مشاهده همه محصولات فروشگاه</span><?php echo higer_cat_icon( 'chevron-left', 13 ); // phpcs:ignore ?></a>
								<?php endif; ?>
							</div>
						</details>
						<?php elseif ( count( $siblings ) > 1 || $parent_cat ) : ?>
						<details class="hc-fgroup">
							<summary><span><?php echo higer_cat_icon( 'bed', 15 ); // phpcs:ignore ?> دسته‌های مرتبط</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
							<div class="hc-fbody">
								<ul class="hc-cat-tree">
									<?php if ( $parent_cat && '' !== $parent_cat['url'] ) : ?>
									<li>
										<a class="hc-cat-row" href="<?php echo esc_url( $parent_cat['url'] ); ?>">
											<span class="hc-radio" aria-hidden="true"></span>
											<span class="hc-cat-name">همه <?php echo esc_html( $parent_cat['name'] ); ?></span>
											<em class="hc-fcount"><?php echo esc_html( $fa( $cat_cnt( $parent_cat ) ) ); ?></em>
										</a>
									</li>
									<?php endif; ?>
									<?php foreach ( $siblings as $sib ) : $is_cur = $sib['slug'] === $ctx['category']; ?>
									<li style="--depth:<?php echo $parent_cat ? 1 : 0; ?>">
										<a class="hc-cat-row" href="<?php echo esc_url( $sib['url'] ); ?>"<?php echo $is_cur ? ' aria-current="page"' : ''; ?>>
											<span class="hc-radio" aria-hidden="true"></span>
											<span class="hc-cat-name"><?php echo esc_html( $sib['name'] ); ?></span>
											<em class="hc-fcount"><?php echo esc_html( $fa( $cat_cnt( $sib ) ) ); ?></em>
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php if ( '' !== $ctx['shop_url'] ) : ?>
								<a class="hc-cat-all-link" href="<?php echo esc_url( $ctx['shop_url'] ); ?>"><span>همه محصولات فروشگاه</span><?php echo higer_cat_icon( 'chevron-left', 13 ); // phpcs:ignore ?></a>
								<?php endif; ?>
							</div>
						</details>
						<?php endif; ?>
					<?php elseif ( $categories ) : ?>
					<details class="hc-fgroup" open>
						<summary><span><?php echo higer_cat_icon( 'bed', 15 ); // phpcs:ignore ?> دسته‌بندی و ساختار</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody">
							<ul class="hc-cat-tree">
								<li>
									<button type="button" class="hc-cat-row" data-hc-cat="" aria-pressed="<?php echo '' === $ctx['category'] ? 'true' : 'false'; ?>">
										<span class="hc-radio" aria-hidden="true"></span>
										<span class="hc-cat-name">همه محصولات</span>
										<em class="hc-fcount" data-hc-count="cat:"><?php echo esc_html( $total_fa ); ?></em>
									</button>
								</li>
								<?php foreach ( $categories as $cat ) : ?>
								<li style="--depth:<?php echo (int) $cat['depth']; ?>">
									<button type="button" class="hc-cat-row" data-hc-cat="<?php echo esc_attr( $cat['slug'] ); ?>" aria-pressed="<?php echo $cat['slug'] === $ctx['category'] ? 'true' : 'false'; ?>">
										<span class="hc-radio" aria-hidden="true"></span>
										<span class="hc-cat-name"><?php echo esc_html( $cat['name'] ); ?></span>
										<em class="hc-fcount" data-hc-count="cat:<?php echo esc_attr( $cat['slug'] ); ?>"><?php echo esc_html( $fa( $cat['count'] ) ); ?></em>
									</button>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۵. درجه سفتی -->
					<?php if ( ! empty( $facets['firmness'] ) ) : ?>
					<details class="hc-fgroup" open>
						<summary><span><?php echo higer_cat_icon( 'gauge', 15 ); // phpcs:ignore ?> درجه سفتی</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-check-list">
							<?php foreach ( $facets['firmness'] as $f ) : $f_on = in_array( $f['slug'], $ctx['firmness'], true ); ?>
							<button type="button" class="hc-check-row" data-hc-facet="firmness" data-value="<?php echo esc_attr( $f['slug'] ); ?>" aria-pressed="<?php echo $f_on ? 'true' : 'false'; ?>">
								<span class="hc-box" aria-hidden="true"><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hc-check-label">
									<b><?php echo esc_html( $f['name'] ); ?></b>
									<?php if ( $f['level'] ) : ?><span class="hc-mini-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $scale_max; $i++ ) : ?><i<?php echo $i <= $f['level'] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?>
								</span>
								<em class="hc-fcount" data-hc-count="firmness:<?php echo esc_attr( $f['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۶. چیدمان لایه‌ها -->
					<?php if ( ! empty( $facets['layers'] ) ) : ?>
					<details class="hc-fgroup" open>
						<summary><span><?php echo higer_cat_icon( 'layers', 15 ); // phpcs:ignore ?> چیدمان لایه‌ها</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-check-list">
							<?php foreach ( $facets['layers'] as $l ) : $l_on = in_array( $l['slug'], $ctx['layer'], true ); ?>
							<button type="button" class="hc-check-row" data-hc-facet="layer" data-value="<?php echo esc_attr( $l['slug'] ); ?>" aria-pressed="<?php echo $l_on ? 'true' : 'false'; ?>">
								<span class="hc-box" aria-hidden="true"><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hc-check-label"><b><?php echo esc_html( $l['name'] ); ?></b></span>
								<em class="hc-fcount" data-hc-count="layer:<?php echo esc_attr( $l['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۷. مدت گارانتی -->
					<?php if ( ! empty( $facets['warranty'] ) ) : ?>
					<details class="hc-fgroup" open>
						<summary><span><?php echo higer_cat_icon( 'shield', 15 ); // phpcs:ignore ?> مدت گارانتی</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-pill-list">
							<?php foreach ( $facets['warranty'] as $w ) : $w_on = in_array( $w['slug'], $ctx['warranty'], true ); ?>
							<button type="button" class="hc-fpill" data-hc-facet="warranty" data-value="<?php echo esc_attr( $w['slug'] ); ?>" aria-pressed="<?php echo $w_on ? 'true' : 'false'; ?>">
								<b><?php echo esc_html( $w['name'] ); ?></b>
								<em data-hc-count="warranty:<?php echo esc_attr( $w['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۸. لایه ویژه -->
					<?php if ( ! empty( $facets['special'] ) ) : ?>
					<details class="hc-fgroup" open>
						<summary><span><?php echo higer_cat_icon( 'cloud', 15 ); // phpcs:ignore ?> لایه ویژه</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-check-list">
							<?php foreach ( $facets['special'] as $sl ) : $sl_on = in_array( $sl['slug'], $ctx['special'], true ); ?>
							<button type="button" class="hc-check-row" data-hc-facet="special" data-value="<?php echo esc_attr( $sl['slug'] ); ?>" aria-pressed="<?php echo $sl_on ? 'true' : 'false'; ?>">
								<span class="hc-box" aria-hidden="true"><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hc-check-label"><b><?php echo esc_html( $sl['name'] ); ?></b></span>
								<em class="hc-fcount" data-hc-count="special:<?php echo esc_attr( $sl['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۹. نوع فنر -->
					<?php if ( ! empty( $facets['spring'] ) ) : ?>
					<details class="hc-fgroup">
						<summary><span><?php echo higer_cat_icon( 'spring', 15 ); // phpcs:ignore ?> نوع فنر</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-check-list">
							<?php foreach ( $facets['spring'] as $sp ) : $sp_on = in_array( $sp['slug'], $ctx['spring'], true ); ?>
							<button type="button" class="hc-check-row" data-hc-facet="spring" data-value="<?php echo esc_attr( $sp['slug'] ); ?>" aria-pressed="<?php echo $sp_on ? 'true' : 'false'; ?>">
								<span class="hc-box" aria-hidden="true"><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hc-check-label"><b><?php echo esc_html( $sp['name'] ); ?></b></span>
								<em class="hc-fcount" data-hc-count="spring:<?php echo esc_attr( $sp['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۱۰. جنس پارچه -->
					<?php if ( ! empty( $facets['fabric'] ) ) : ?>
					<details class="hc-fgroup">
						<summary><span><?php echo higer_cat_icon( 'fabric', 15 ); // phpcs:ignore ?> جنس پارچه</span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-check-list">
							<?php foreach ( $facets['fabric'] as $fb ) : $fb_on = in_array( $fb['slug'], $ctx['fabric'], true ); ?>
							<button type="button" class="hc-check-row" data-hc-facet="fabric" data-value="<?php echo esc_attr( $fb['slug'] ); ?>" aria-pressed="<?php echo $fb_on ? 'true' : 'false'; ?>">
								<span class="hc-box" aria-hidden="true"><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hc-check-label"><b><?php echo esc_html( $fb['name'] ); ?></b></span>
								<em class="hc-fcount" data-hc-count="fabric:<?php echo esc_attr( $fb['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۱۱. ویژگی‌های سفارشی آینده در ووکامرس -->
					<?php foreach ( $facets['extra'] as $ex ) : ?>
					<details class="hc-fgroup">
						<summary><span><?php echo esc_html( $ex['label'] ); ?></span><?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hc-fbody hc-check-list">
							<?php foreach ( $ex['terms'] as $et ) : ?>
							<button type="button" class="hc-check-row" data-hc-extra="<?php echo esc_attr( $ex['tax'] ); ?>" data-value="<?php echo esc_attr( $et['slug'] ); ?>" aria-pressed="false">
								<span class="hc-box" aria-hidden="true"><?php echo higer_cat_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hc-check-label"><b><?php echo esc_html( $et['name'] ); ?></b></span>
								<em class="hc-fcount" data-hc-count="extra:<?php echo esc_attr( $ex['tax'] . ':' . $et['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endforeach; ?>

					<!-- کارت راهنمای تشک‌سنج هیگر -->
					<?php if ( $show_finder ) : ?>
					<a class="hc-finder-cta" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
						<span class="hc-finder-ico" aria-hidden="true"><?php echo higer_cat_icon( 'sparkles', 20 ); // phpcs:ignore ?></span>
						<span class="hc-finder-copy">
							<b>تشک‌سنج هیگر</b>
							<small><?php echo esc_html( '' !== $ctx['finder_text'] ? $ctx['finder_text'] : 'مطمئن نیستید کدام مدل مناسب شماست؟ با چند سؤال بررسی کنید' ); ?></small>
						</span>
						<span class="hc-finder-go">شروع <?php echo higer_cat_icon( 'chevron-left', 14 ); // phpcs:ignore ?></span>
					</a>
					<?php endif; ?>
				</div>

				<div class="hc-sidebar-foot">
					<button type="button" class="hc-btn-gold hc-drawer-apply" data-hc-drawer-close>مشاهده <span data-hc-result-num><?php echo esc_html( $total_fa ); ?></span> محصول</button>
				</div>
			</aside>

			<!-- ===== بخش نتایج و کارت‌های محصول ===== -->
			<div class="hc-content">
				<!-- نوار بالای لیست در دسکتاپ -->
				<div class="hc-toolbar">
					<div class="hc-result-meta" role="status" aria-live="polite">
						<span>نمایش <b data-hc-shown-count><?php echo esc_html( $vis_fa ); ?></b> از <?php echo esc_html( $total_fa ); ?> <?php echo $is_cat_page ? esc_html( 'محصول در ' . $ctx['cat_name'] ) : 'محصول'; ?></span>
						<span class="hc-size-banner" data-hc-size-banner hidden></span>
					</div>
					<div class="hc-toolbar-end">
						<label class="hc-sort-box">
							<span>مرتب‌سازی:</span>
							<select data-hc-sort>
								<option value="default"><?php echo $is_cat_page ? 'پیش‌فرض دسته' : 'پیش‌فرض فروشگاه'; ?></option>
								<option value="price-asc">ارزان‌ترین</option>
								<option value="price-desc">گران‌ترین</option>
								<?php if ( $has_warranty ) : ?><option value="warranty-desc">بیشترین گارانتی</option><?php endif; ?>
								<?php if ( $has_firmness ) : ?>
								<option value="firm-asc">نرم‌ترین به سفت‌ترین</option>
								<option value="firm-desc">سفت‌ترین به نرم‌ترین</option>
								<?php endif; ?>
								<option value="name-asc">حروف الفبا</option>
							</select>
						</label>
						<div class="hc-view-switch" role="group" aria-label="حالت نمایش">
							<button type="button" data-hc-view="grid" aria-pressed="true" aria-label="نمایش شبکه‌ای"><?php echo higer_cat_icon( 'grid', 16 ); // phpcs:ignore ?></button>
							<button type="button" data-hc-view="list" aria-pressed="false" aria-label="نمایش فهرستی"><?php echo higer_cat_icon( 'list', 16 ); // phpcs:ignore ?></button>
						</div>
					</div>
				</div>

				<!-- نوار چسبنده فیلترهای فعال -->
				<div class="hc-active-bar" data-hc-active-bar hidden>
					<div class="hc-active-bar-inner">
						<div class="hc-active-chips" data-hc-active-chips></div>
						<button type="button" class="hc-clear-all" data-hc-reset>پاک کردن همه فیلترها</button>
					</div>
				</div>

				<!-- شبکه کارت‌های محصولات (رندر سمت سرور برای سئو + فیلتر آنی) -->
				<div class="hc-grid" data-hc-grid data-view="grid">
					<?php foreach ( $products as $p ) :
						$c_key = $p['core']['key'];
						$p_cat = $p['primaryCat'] ? $p['primaryCat']['name'] : '';
						?>
					<article class="hc-card<?php echo $p['inStock'] ? '' : ' is-out'; ?>" data-hc-card="<?php echo (int) $p['id']; ?>"<?php echo ( ! $p['inStock'] && $hide_out ) ? ' hidden' : ''; ?>>
						<div class="hc-card-media">
							<a class="hc-card-img-link" href="<?php echo esc_url( $p['url'] ); ?>" data-hc-link="<?php echo (int) $p['id']; ?>">
								<?php if ( '' !== $p['image'] ) : ?>
								<img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( '' !== $p['short'] ? $p['short'] : $p['name'] ); ?>" loading="lazy" decoding="async">
								<?php else : ?>
								<span class="hc-card-svg-wrap"><?php echo higer_cat_core_svg( $c_key ); // phpcs:ignore ?></span>
								<?php endif; ?>
							</a>
							<div class="hc-card-badges">
								<?php if ( '' !== $p_cat ) : ?><span class="hc-pill-cat"><?php echo esc_html( $p_cat ); ?></span><?php endif; ?>
								<?php if ( $p['warranty'] ) : ?><span class="hc-pill-war"><?php echo higer_cat_icon( 'shield', 12 ); // phpcs:ignore ?> گارانتی <?php echo esc_html( $p['warranty']['name'] ); ?></span><?php endif; ?>
								<?php if ( ! $p['inStock'] ) : ?><span class="hc-pill-out">ناموجود</span><?php elseif ( $p['onSale'] ) : ?><span class="hc-pill-sale">تخفیف</span><?php endif; ?>
							</div>
							<button type="button" class="hc-card-cmp-ico" data-hc-cmp="<?php echo (int) $p['id']; ?>" aria-pressed="false" aria-label="<?php echo esc_attr( 'افزودن ' . $p['name'] . ' به مقایسه' ); ?>">
								<span class="hc-cmp-off"><?php echo higer_cat_icon( 'compare', 13 ); // phpcs:ignore ?> مقایسه</span>
								<span class="hc-cmp-on"><?php echo higer_cat_icon( 'check', 13 ); // phpcs:ignore ?> در مقایسه</span>
							</button>
						</div>

						<div class="hc-card-body">
							<div class="hc-card-head">
								<h2 class="hc-card-title"><a href="<?php echo esc_url( $p['url'] ); ?>" data-hc-link="<?php echo (int) $p['id']; ?>"><?php echo esc_html( $p['name'] ); ?></a></h2>
								<?php if ( '' !== $p['short'] ) : ?><p class="hc-card-sub"><?php echo esc_html( $p['short'] ); ?></p><?php endif; ?>
							</div>

							<ul class="hc-card-specs" aria-label="ویژگی‌های کلیدی">
								<?php if ( '' !== $p['core']['title'] && 'accessory' !== $c_key ) : ?>
								<li><?php echo higer_cat_icon( 'bed', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $p['core']['title'] ); ?></span></li>
								<?php endif; ?>
								<?php if ( $p['firmness'] ) : ?>
								<li>
									<?php echo higer_cat_icon( 'gauge', 12 ); // phpcs:ignore ?>
									<span><?php echo esc_html( $p['firmness']['name'] ); ?></span>
									<?php if ( $p['firmness']['level'] ) : ?><span class="hc-mini-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $scale_max; $i++ ) : ?><i<?php echo $i <= $p['firmness']['level'] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?>
								</li>
								<?php endif; ?>
								<?php if ( $p['layer'] ) : ?>
								<li><?php echo higer_cat_icon( 'layers', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $p['layer']['name'] ); ?></span></li>
								<?php endif; ?>
								<?php foreach ( $p['special'] as $sl ) : ?>
								<li class="is-accent"><?php echo higer_cat_icon( 'cloud', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $sl['name'] ); ?></span></li>
								<?php endforeach; ?>
								<?php foreach ( $p['spring'] as $sp ) : ?>
								<li><?php echo higer_cat_icon( 'spring', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $sp['name'] ); ?></span></li>
								<?php endforeach; ?>
								<?php if ( '' !== $p['sizeSum'] ) : ?>
								<li><?php echo higer_cat_icon( 'ruler', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $p['sizeSum'] ); ?></span></li>
								<?php endif; ?>
							</ul>

							<div class="hc-card-price-box">
								<small data-hc-card-plabel="<?php echo (int) $p['id']; ?>"><?php echo esc_html( $p['max'] > $p['min'] ? 'محدوده قیمت' : 'قیمت' ); ?></small>
								<div class="hc-card-price-row">
									<strong data-hc-card-price="<?php echo (int) $p['id']; ?>"><?php echo esc_html( $p['rangeText'] ); ?></strong>
									<del data-hc-card-reg="<?php echo (int) $p['id']; ?>" hidden></del>
								</div>
							</div>

							<div class="hc-card-actions">
								<a class="hc-btn-primary" href="<?php echo esc_url( $p['url'] ); ?>" data-hc-link="<?php echo (int) $p['id']; ?>">مشاهده محصول <?php echo higer_cat_icon( 'chevron-left', 14 ); // phpcs:ignore ?></a>
								<?php if ( ! empty( $p['sizes'] ) ) : ?>
								<button type="button" class="hc-btn-sec" data-hc-quick="<?php echo (int) $p['id']; ?>"><?php echo higer_cat_icon( 'eye', 14 ); // phpcs:ignore ?> سایزها و قیمت</button>
								<?php endif; ?>
							</div>
						</div>
					</article>
					<?php endforeach; ?>
				</div>

				<!-- حالت بدون نتیجه -->
				<div class="hc-empty" data-hc-empty hidden>
					<div class="hc-empty-ico"><?php echo higer_cat_icon( 'search', 28 ); // phpcs:ignore ?></div>
					<h3>محصولی با این ترکیب از فیلترها پیدا نشد</h3>
					<p>می‌توانید برخی از فیلترها را بردارید یا همه فیلترها را پاک کنید تا دوباره تمام مدل‌ها نمایش داده شوند.</p>
					<div class="hc-empty-actions">
						<button type="button" class="hc-btn-gold" data-hc-reset><?php echo higer_cat_icon( 'reset', 16 ); // phpcs:ignore ?> پاک کردن همه فیلترها</button>
						<?php if ( $is_cat_page && '' !== $ctx['shop_url'] ) : ?><a class="hc-btn-sec" href="<?php echo esc_url( $ctx['shop_url'] ); ?>">مشاهده همه محصولات فروشگاه</a><?php elseif ( $show_finder ) : ?><a class="hc-btn-sec" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>"><?php echo higer_cat_icon( 'sparkles', 16 ); // phpcs:ignore ?> راهنمای تشک‌سنج</a><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $is_cat_page && '' !== $ctx['long_desc'] ) : ?>
	<!-- ===== راهنمای تکمیلی و سئوی دسته‌بندی (از توضیحات دسته در ووکامرس) ===== -->
	<section class="hc-cat-guide-sec" aria-label="راهنمای <?php echo esc_attr( $ctx['cat_name'] ); ?>">
		<div class="hc-wrap">
			<div class="hc-cat-guide">
				<span class="hc-kicker">درباره این دسته‌بندی</span>
				<h2 class="hc-cat-guide-title">راهنمای خرید <?php echo esc_html( $ctx['cat_name'] ); ?></h2>
				<div class="hc-cat-guide-body is-clamped" data-hc-guide-body><?php echo $ctx['long_desc']; // phpcs:ignore ?></div>
				<button type="button" class="hc-cat-guide-btn" data-hc-guide-toggle aria-expanded="false">
					<span>مطالعه کامل راهنمای دسته</span>
					<?php echo higer_cat_icon( 'chevron-down', 15 ); // phpcs:ignore ?>
				</button>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== نوار تماس پایین صفحه ===== -->
	<section class="hc-cta">
		<div class="hc-wrap hc-cta-inner">
			<div>
				<span class="hc-kicker is-dark">مشاوره خرید</span>
				<?php if ( $is_cat_page ) : ?>
				<h2>برای انتخاب بهترین مدل <span class="hc-gold-text"><?php echo esc_html( $ctx['cat_name'] ); ?></span> راهنمایی می‌خواهید؟</h2>
				<?php else : ?>
				<h2>برای انتخاب سایز یا مدل نیاز به <span class="hc-gold-text">راهنمایی</span> دارید؟</h2>
				<?php endif; ?>
				<p><?php echo higer_cat_icon( 'map', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['address'] ); ?></p>
				<p><?php echo higer_cat_icon( 'clock', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['hours'] ); ?></p>
			</div>
			<a class="hc-btn-gold" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_cat_icon( 'phone', 18 ); // phpcs:ignore ?> <?php echo esc_html( $store['phone'] ); ?></a>
		</div>
	</section>

	<!-- ===== نوار شناور مقایسه (مشترک با صفحه تک‌محصول) ===== -->
	<div class="hc-cmp-dock" data-hc-cmp-dock hidden>
		<div class="hc-cmp-dock-info">
			<span class="hc-cmp-dock-ico"><?php echo higer_cat_icon( 'compare', 16 ); // phpcs:ignore ?></span>
			<div>
				<b>فهرست مقایسه <span data-hc-cmp-count>(۰)</span></b>
				<div class="hc-cmp-dock-pills" data-hc-cmp-pills></div>
			</div>
		</div>
		<div class="hc-cmp-dock-actions">
			<button type="button" class="hc-cmp-clear" data-hc-cmp-clear>پاک کردن</button>
			<button type="button" class="hc-btn-gold" data-hc-cmp-open>مقایسه جدول کامل</button>
		</div>
	</div>

	<!-- ===== مودال مشاهده سریع سایزها و خرید مستقیم ===== -->
	<div class="hc-modal" data-hc-quick-modal hidden role="dialog" aria-modal="true" aria-label="مشاهده سریع سایزها و قیمت">
		<div class="hc-modal-backdrop" data-hc-modal-close></div>
		<div class="hc-modal-card hc-quick-card" data-hc-quick-body></div>
	</div>

	<!-- ===== مودال جدول مقایسه کامل مدل‌ها ===== -->
	<div class="hc-modal" data-hc-cmp-modal hidden role="dialog" aria-modal="true" aria-label="جدول مقایسه محصولات">
		<div class="hc-modal-backdrop" data-hc-modal-close></div>
		<div class="hc-modal-card hc-cmp-card">
			<div class="hc-modal-head">
				<div>
					<span class="hc-kicker"><?php echo higer_cat_icon( 'compare', 13 ); // phpcs:ignore ?> مقایسه مشخصات و قیمت</span>
					<h3>مقایسه مدل‌های انتخابی</h3>
				</div>
				<div class="hc-cmp-modal-tools">
					<label class="hc-cmp-size-pick">
						<span>قیمت در سایز:</span>
						<select data-hc-cmp-size>
							<option value="">محدوده قیمت</option>
							<?php $cmp_sizes = ! empty( $catalog['facets']['sizes'] ) ? $catalog['facets']['sizes'] : $facets['sizes']; foreach ( $cmp_sizes as $sz ) : ?>
							<option value="<?php echo esc_attr( $sz['slug'] ); ?>"><?php echo esc_html( $sz['label'] . ( '' !== $sz['sub'] ? ' (' . $sz['sub'] . ')' : '' ) ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<button type="button" class="hc-modal-close" data-hc-modal-close aria-label="بستن"><?php echo higer_cat_icon( 'close', 18 ); // phpcs:ignore ?></button>
				</div>
			</div>
			<div class="hc-modal-scroll" data-hc-cmp-table-wrap></div>
		</div>
	</div>
</div>
<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_category' ) ) {
	add_shortcode( 'higer_category', 'higer_cat_render' );
}

if ( ! function_exists( 'higer_cat_is_elementor_preview' ) ) {
	/** جلوگیری از تداخل هنگام باز کردن ویرایشگر المنتور. */
	function higer_cat_is_elementor_preview() {
		if ( isset( $_GET['elementor-preview'] ) || isset( $_GET['preview_id'] ) ) { // phpcs:ignore
			return true;
		}
		if ( class_exists( '\Elementor\Plugin' ) ) {
			$el = \Elementor\Plugin::$instance;
			if ( isset( $el->preview ) && method_exists( $el->preview, 'is_preview_mode' ) && $el->preview->is_preview_mode() ) {
				return true;
			}
			if ( isset( $el->editor ) && method_exists( $el->editor, 'is_edit_mode' ) && $el->editor->is_edit_mode() ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'higer_cat_archive_already_has_shortcode' ) ) {
	/** اگر قالب Product Archive المنتور خودش شورت‌کد [higer_category] را دارد، دوباره رندر نشود. */
	function higer_cat_archive_already_has_shortcode() {
		if ( ! class_exists( '\ElementorPro\Modules\ThemeBuilder\Module' ) ) {
			return false;
		}
		try {
			$module = \ElementorPro\Modules\ThemeBuilder\Module::instance();
			if ( ! $module || ! method_exists( $module, 'get_conditions_manager' ) ) {
				return false;
			}
			$cm = $module->get_conditions_manager();
			if ( ! $cm || ! method_exists( $cm, 'get_documents_for_location' ) ) {
				return false;
			}
			$docs = (array) $cm->get_documents_for_location( 'archive' );
			foreach ( array_keys( $docs ) as $doc_id ) {
				$doc_id = (int) $doc_id;
				if ( $doc_id <= 0 ) {
					continue;
				}
				$data = (string) get_post_meta( $doc_id, '_elementor_data', true );
				if ( false !== strpos( $data, '[higer_category' ) ) {
					return true;
				}
				$post = function_exists( 'get_post' ) ? get_post( $doc_id ) : null;
				if ( $post && ! empty( $post->post_content ) && false !== strpos( (string) $post->post_content, '[higer_category' ) ) {
					return true;
				}
			}
		} catch ( \Throwable $e ) {
			return false;
		}
		return false;
	}
}

if ( ! function_exists( 'higer_cat_auto_replace' ) ) {
	/**
	 * جایگزینی خودکار صفحات دسته‌بندی ووکامرس (/product-category/...) با حفظ کامل هدر و فوتر سایت
	 * (حتی در صورت وجود قالب قدیمی Product Archive در المنتور پرو، و بدون دوباره‌کاری اگر شورت‌کد [higer_category]
	 * داخل قالب المنتور گذاشته شده باشد).
	 */
	function higer_cat_auto_replace() {
		if ( is_admin() || ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || is_feed() || ( function_exists( 'is_embed' ) && is_embed() ) || is_404() ) {
			return;
		}
		$cfg = higer_cat_config();

		/* ۱. صفحات دسته‌بندی محصول (/product-category/...) */
		$is_cat = function_exists( 'is_product_category' ) && is_product_category();
		if ( $is_cat && ! empty( $cfg['auto_replace_categories'] ) && ! higer_cat_is_elementor_preview() ) {
			$term = function_exists( 'get_queried_object' ) ? get_queried_object() : null;
			if ( is_object( $term ) && isset( $term->taxonomy ) && 'product_cat' === $term->taxonomy && ! higer_cat_archive_already_has_shortcode() ) {
				add_filter( 'body_class', function ( $classes ) use ( $term ) {
					$classes[] = 'higer-cat-cat-archive';
					$classes[] = 'higer-cat-cat-' . sanitize_html_class( (string) $term->slug );
					return $classes;
				} );
				if ( function_exists( 'get_header' ) && function_exists( 'get_footer' ) ) {
					get_header( 'shop' );
					echo '<main id="content" class="site-main higer-cat-archive-main" role="main">';
					echo higer_cat_render(); // phpcs:ignore
					echo '</main>';
					get_footer( 'shop' );
					exit;
				}
			}
		}

		/* این اسنیپت فقط برای صفحات دسته‌بندی (/product-category/...) است؛
		 * صفحه اصلی فروشگاه (/shop/) و سایر آرشیوها دست نمی‌خورند. */
		return;
	}
	function higer_cat_auto_output() {
		echo higer_cat_render(); // phpcs:ignore
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'template_redirect', 'higer_cat_auto_replace', 20 );
	}
}
