<?php
/**
 * Higer Shop — صفحه فروشگاه و آرشیو محصولات هیگر | نسخه بدون بیلد (v1.0)
 * =====================================================================
 * اسنیپت PHP برای WPCode که صفحه فروشگاه (/shop/)، آرشیو دسته‌بندی‌ها
 * (/product-category/...)، آرشیو ویژگی‌ها و صفحه جستجوی محصولات ووکامرس
 * را با طراحی هماهنگ با صفحه اصلی و صفحه تک‌محصول هیگر نمایش می‌دهد.
 *
 * تمام دسته‌بندی‌ها، ویژگی‌ها (سایز، سفتی، گارانتی، چیدمان لایه‌ها، نوع فنر،
 * لایه ویژه، جنس پارچه و هر ویژگی جدید آینده)، قیمت دقیق هر سایز و وضعیت
 * موجودی مستقیم از خود ووکامرس خوانده می‌شوند.
 *
 * ─── نصب در WPCode ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل این فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *  ۴. Save و Activate
 *
 * ─── نمایش در صفحه فروشگاه و دسته‌بندی‌ها ───
 *  با المنتور پرو (روش فعلی سایت):
 *    Templates > Theme Builder > Product Archive
 *    قالب آرشیو محصولات را باز کنید، ویجت‌های قبلی لیست و فیلتر را حذف کنید
 *    و یک ویجت Shortcode در یک بخش تمام‌عرض قرار دهید:   [higer_shop]
 *    همچنین در برگه «فروشگاه» (/shop/) اگر جداگانه با المنتور ساخته شده،
 *    همین شورت‌کد [higer_shop] را قرار دهید.
 *  صفحات دسته‌بندی (/product-category/...): به‌صورت خودکار با هدر و فوتر
 *    فعلی سایت و با سربرگ اختصاصی هر دسته نمایش داده می‌شوند ('auto_replace_categories' => true).
 *    اگر در قالب Product Archive المنتور شورت‌کد [higer_shop] بگذارید، خودکار بدون تکرار کار می‌کند.
 *  صفحه اصلی فروشگاه بدون المنتور: در تنظیمات پایین 'auto_replace' را true کنید.
 *
 * ─── شورت‌کدها ───
 *  [higer_shop]                              تشخیص خودکار (همه محصولات / دسته‌بندی فعلی / جستجو)
 *  [higer_shop category="high-density-foam"] نمایش پیش‌فرض یک دسته مشخص
 *  [higer_shop fullwidth="no"]               بدون حالت تمام‌عرض
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_shop_config' ) ) :
function higer_shop_config() {
	return array(

		/* --- فروشگاه و تماس --- */
		'store' => array(
			'phone'   => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'     => 'tel:+989111186485',
			'address' => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی 27، فروشگاه و دفتر مرکزی هیگر',
			'hours'   => 'همه روزه بجز روزهای تعطیل،ساعت ۹ تا ۲۱',
		),

		/* --- رفتار اسنیپت --- */
		'auto_replace'            => false, // true = جایگزینی خودکار صفحه اصلی فروشگاه (/shop/) بدون المنتور
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

if ( ! function_exists( 'higer_shop_fa' ) ) {
	function higer_shop_fa( $value ) {
		return str_replace(
			array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
			array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ),
			(string) $value
		);
	}
}

if ( ! function_exists( 'higer_shop_en_digits' ) ) {
	function higer_shop_en_digits( $value ) {
		return str_replace(
			array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ),
			array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ),
			(string) $value
		);
	}
}

if ( ! function_exists( 'higer_shop_number' ) ) {
	function higer_shop_number( $amount ) {
		$decimals = function_exists( 'wc_get_price_decimals' ) ? (int) wc_get_price_decimals() : 0;
		return higer_shop_fa( number_format( (float) $amount, $decimals, '.', ',' ) );
	}
}

if ( ! function_exists( 'higer_shop_money' ) ) {
	function higer_shop_money( $amount ) {
		$symbol = function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '';
		$symbol = trim( html_entity_decode( (string) $symbol, ENT_QUOTES, 'UTF-8' ) );
		return higer_shop_number( $amount ) . ' ' . ( '' !== $symbol ? $symbol : 'تومان' );
	}
}

if ( ! function_exists( 'higer_shop_size_parts' ) ) {
	function higer_shop_size_parts( $value ) {
		$norm = higer_shop_en_digits( $value );
		return preg_match( '/^(\d+)\s*(?:x|×|\*|در)\s*(\d+)$/iu', trim( $norm ), $m ) ? array( (int) $m[1], (int) $m[2] ) : null;
	}
}

if ( ! function_exists( 'higer_shop_size_text' ) ) {
	function higer_shop_size_text( $slug, $name ) {
		$parts = higer_shop_size_parts( $slug );
		if ( ! $parts ) {
			$parts = higer_shop_size_parts( $name );
		}
		return $parts ? higer_shop_fa( $parts[0] . '×' . $parts[1] ) : higer_shop_fa( $name );
	}
}

if ( ! function_exists( 'higer_shop_size_compare' ) ) {
	function higer_shop_size_compare( $a, $b ) {
		$pa = higer_shop_size_parts( $a );
		$pb = higer_shop_size_parts( $b );
		if ( ! $pa || ! $pb ) {
			return strcmp( (string) $a, (string) $b );
		}
		return ( $pa[0] === $pb[0] ) ? $pa[1] - $pb[1] : $pa[0] - $pb[0];
	}
}

if ( ! function_exists( 'higer_shop_num_compare' ) ) {
	function higer_shop_num_compare( $a, $b ) {
		$na = preg_match( '/(\d+)/', higer_shop_en_digits( $a ), $ma ) ? (int) $ma[1] : 0;
		$nb = preg_match( '/(\d+)/', higer_shop_en_digits( $b ), $mb ) ? (int) $mb[1] : 0;
		return ( $na === $nb ) ? strcmp( (string) $a, (string) $b ) : ( $na - $nb );
	}
}

if ( ! function_exists( 'higer_shop_terms' ) ) {
	function higer_shop_terms( $product_id, $taxonomy ) {
		if ( ! $taxonomy || ! taxonomy_exists( $taxonomy ) ) {
			return array();
		}
		$terms = wc_get_product_terms( $product_id, $taxonomy, array( 'fields' => 'all' ) );
		return is_array( $terms ) ? array_values( array_filter( $terms, 'is_object' ) ) : array();
	}
}

if ( ! function_exists( 'higer_shop_term_title' ) ) {
	function higer_shop_term_title( $taxonomy, $term, $cfg ) {
		if ( isset( $cfg['term_titles'][ $taxonomy ][ $term->slug ] ) ) {
			return (string) $cfg['term_titles'][ $taxonomy ][ $term->slug ];
		}
		return higer_shop_fa( $term->name );
	}
}

if ( ! function_exists( 'higer_shop_term_url' ) ) {
	function higer_shop_term_url( $term, $taxonomy = 'product_cat' ) {
		$url = $term ? get_term_link( $term, $taxonomy ) : '';
		return ( ! $url || is_wp_error( $url ) ) ? '' : (string) $url;
	}
}

if ( ! function_exists( 'higer_shop_primary_category' ) ) {
	function higer_shop_primary_category( $product_id ) {
		$best  = null;
		$terms = higer_shop_terms( $product_id, 'product_cat' );
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

if ( ! function_exists( 'higer_shop_core_for' ) ) {
	function higer_shop_core_for( $path, $cfg ) {
		foreach ( array_reverse( (array) $path ) as $term ) {
			if ( isset( $cfg['cores'][ $term->slug ] ) ) {
				return $cfg['cores'][ $term->slug ] + array( 'slug' => $term->slug );
			}
		}
		return null;
	}
}

if ( ! function_exists( 'higer_shop_firmness_max' ) ) {
	function higer_shop_firmness_max( $taxonomy ) {
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

if ( ! function_exists( 'higer_shop_collect_product' ) ) {
	function higer_shop_collect_product( $item, $cfg, $index = 0 ) {
		$id       = (int) $item->get_id();
		$keys     = $cfg['attributes'];
		$variable = $item->is_type( 'variable' );
		$short    = trim( wp_strip_all_tags( (string) $item->get_short_description() ) );
		$cat_info = higer_shop_primary_category( $id );
		$core     = $cat_info ? higer_shop_core_for( $cat_info['path'], $cfg ) : null;

		/* همه دسته‌های محصول به همراه والدها برای فیلتر درختی */
		$cat_slugs = array();
		$cat_names = array();
		foreach ( higer_shop_terms( $id, 'product_cat' ) as $ct ) {
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
		foreach ( higer_shop_terms( $id, $size_tax ) as $st ) {
			$size_map[ $st->slug ] = array(
				'label'       => higer_shop_size_text( $st->slug, $st->name ),
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
						'priceText'   => $vp > 0 ? higer_shop_money( $vp ) : '',
						'regularText' => $vr > $vp ? higer_shop_money( $vr ) : '',
						'inStock'     => $vi,
					);
					if ( '' === $v_size ) {
						if ( null === $any_var || $vp < $any_var['price'] ) {
							$any_var = $entry;
						}
					} else {
						if ( ! isset( $size_map[ $v_size ] ) ) {
							$size_map[ $v_size ] = array(
								'label' => higer_shop_size_text( $v_size, $v_size ),
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
			uksort( $size_map, 'higer_shop_size_compare' );
		}

		/* سفتی، گارانتی، چیدمان لایه‌ها، نوع فنر، لایه ویژه، جنس پارچه */
		$firm_terms = higer_shop_terms( $id, $keys['firmness'] );
		$firm       = $firm_terms ? $firm_terms[0] : null;
		$firm_max   = higer_shop_firmness_max( $keys['firmness'] );
		$firm_level = ( $firm && preg_match( '/(\d+)$/', $firm->slug, $fm ) ) ? (int) $fm[1] : 0;

		$war_terms = higer_shop_terms( $id, $keys['warranty'] );
		$war       = $war_terms ? $war_terms[0] : null;
		$war_years = ( $war && preg_match( '/(\d+)/', higer_shop_en_digits( $war->slug . ' ' . $war->name ), $wm ) ) ? (int) $wm[1] : 0;

		$lay_terms = higer_shop_terms( $id, $keys['layer'] );
		$lay       = $lay_terms ? $lay_terms[0] : null;

		$multi_groups = array( 'spring', 'special', 'fabric' );
		$multi_data   = array();
		foreach ( $multi_groups as $gk ) {
			$tax               = $keys[ $gk ];
			$multi_data[ $gk ] = array();
			foreach ( higer_shop_terms( $id, $tax ) as $mt ) {
				$multi_data[ $gk ][] = array(
					'slug' => $mt->slug,
					'name' => higer_shop_term_title( $tax, $mt, $cfg ),
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
						$extra[ $aname ]['items'][] = array( 'slug' => $at->slug, 'name' => higer_shop_fa( $at->name ) );
					}
				}
			}
		}

		$image_id = (int) $item->get_image_id();
		$image    = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : '';
		$size_lbl = array_values( wp_list_pluck( $size_map, 'label' ) );
		$size_sum = $size_lbl ? ( 1 === count( $size_lbl ) ? $size_lbl[0] : higer_shop_fa( count( $size_lbl ) ) . ' سایز: ' . $size_lbl[0] . ' تا ' . $size_lbl[ count( $size_lbl ) - 1 ] ) : '';
		$range    = $min > 0 ? ( $max > $min ? higer_shop_number( $min ) . ' تا ' . higer_shop_money( $max ) : higer_shop_money( $min ) ) : 'تماس بگیرید';

		/* رشته جستجوی جامع (انگلیسی + فارسی + کد + دسته‌ها + ویژگی‌ها) */
		$search_parts = array(
			$item->get_name(),
			$short,
			(string) $item->get_sku(),
			implode( ' ', $cat_names ),
			$core ? $core['title'] : '',
			$firm ? $firm->name : '',
			$war ? higer_shop_fa( $war->name ) : '',
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
				'url'  => higer_shop_term_url( $cat_info['term'], 'product_cat' ),
			) : null,
			'core'       => $core ? array( 'key' => $core['key'], 'title' => $core['title'], 'slug' => $core['slug'] ) : array( 'key' => 'generic', 'title' => '', 'slug' => '' ),
			'sizeKey'    => $size_key,
			'sizes'      => $size_map,
			'sizeSum'    => $size_sum,
			'firmness'   => $firm ? array( 'slug' => $firm->slug, 'name' => $firm->name, 'level' => $firm_level, 'max' => $firm_max ) : null,
			'warranty'   => $war ? array( 'slug' => $war->slug, 'name' => higer_shop_fa( $war->name ), 'years' => $war_years ) : null,
			'layer'      => $lay ? array( 'slug' => $lay->slug, 'name' => $lay->name ) : null,
			'spring'     => $multi_data['spring'],
			'special'    => $multi_data['special'],
			'fabric'     => $multi_data['fabric'],
			'extra'      => $extra,
			'search'     => $search_blob,
		);
	}
}

if ( ! function_exists( 'higer_shop_build_categories' ) ) {
	function higer_shop_build_categories( $products ) {
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
				'url'          => higer_shop_term_url( $t, 'product_cat' ),
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

if ( ! function_exists( 'higer_shop_catalog' ) ) {
	/** کل کاتالوگ فروشگاه و گزینه‌های فیلتر را جمع‌آوری و کش می‌کند. */
	function higer_shop_catalog( $cfg ) {
		$hours  = isset( $cfg['shop_cache'] ) ? (float) $cfg['shop_cache'] : 0;
		$ckey   = '';
		$cached = false;
		if ( $hours > 0 && function_exists( 'get_transient' ) ) {
			$ver    = class_exists( 'WC_Cache_Helper' ) ? WC_Cache_Helper::get_transient_version( 'product' ) : '';
			$ckey   = 'higer_shop_' . md5( wp_json_encode( array( 3, $ver, $cfg['attributes'], $cfg['size_labels'], $cfg['cores'], $cfg['term_titles'] ) ) );
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
			$p          = higer_shop_collect_product( $item, $cfg, $idx++ );
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

		uksort( $sizes, 'higer_shop_size_compare' );
		uasort( $firmness, function ( $a, $b ) { return $a['level'] - $b['level']; } );
		uksort( $warranty, 'higer_shop_num_compare' );
		foreach ( $extras as $tax => $ex ) {
			$extras[ $tax ]['terms'] = array_values( $ex['terms'] );
		}

		$out = array(
			'products'   => $products,
			'categories' => higer_shop_build_categories( $products ),
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

if ( ! function_exists( 'higer_shop_scope_catalog' ) ) {
	/**
	 * استخراج محصولات، فیلترهای واقعی، بازه قیمت، آمار و زیردسته‌ها/هم‌رده‌های
	 * مختص به یک دسته‌بندی از روی کاتالوگ کش‌شده (بدون کوئری اضافه به دیتابیس).
	 */
	function higer_shop_scope_catalog( $catalog, $cat_slug, $cfg ) {
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

		uksort( $sizes, 'higer_shop_size_compare' );
		uasort( $firmness, function ( $a, $b ) { return (int) $a['level'] - (int) $b['level']; } );
		uksort( $warranty, 'higer_shop_num_compare' );
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
			'value' => higer_shop_fa( $shown_total ) . ' مدل',
			'attr'  => 'data-hs-cat-stat-count',
		);
		if ( null !== $stat_min && $stat_min > 0 ) {
			$stats[] = array(
				'label' => 'شروع قیمت',
				'value' => higer_shop_money( $stat_min ),
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
				? higer_shop_fa( $stat_war_min ) . ' تا ' . higer_shop_fa( $stat_war_max ) . ' سال'
				: higer_shop_fa( $stat_war_max ) . ' سال';
			$stats[] = array(
				'label' => 'گارانتی رسمی',
				'value' => $w_text,
				'attr'  => '',
			);
		} elseif ( ! empty( $sizes ) ) {
			$stats[] = array(
				'label' => 'تنوع سایز',
				'value' => higer_shop_fa( count( $sizes ) ) . ' سایز',
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

if ( ! function_exists( 'higer_shop_icon' ) ) {
	function higer_shop_icon( $name, $size = 18 ) {
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
		return '<svg class="hs-i" xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
	}
}

if ( ! function_exists( 'higer_shop_core_svg' ) ) {
	function higer_shop_core_svg( $key ) {
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
		return '<svg class="hs-core-svg" viewBox="0 0 320 180" aria-hidden="true" focusable="false">' . $out . '</svg>';
	}
}

if ( ! function_exists( 'higer_shop_assets' ) ) {
	function higer_shop_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		ob_start();
		?>
<style id="higer-shop-css">
/* ================== هیگر — استایل صفحه فروشگاه و آرشیو محصولات (نسخه بدون بیلد) ================== */
.higer-shop{
  --hs-navy-950:#070f1d;--hs-navy-900:#10243e;--hs-navy-800:#183250;--hs-navy-700:#1f3e63;--hs-navy-600:#2b4e77;
  --hs-gold-600:#c8892a;--hs-gold-500:#d9a13b;--hs-gold-400:#e7b95c;--hs-gold-300:#f3d98b;--hs-gold-200:#f8ead0;
  --hs-cream:#faf7ef;--hs-paper:#f3efe3;--hs-line:#e3ddcd;--hs-ok:#047857;--hs-bad:#b91c1c;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--hs-navy-900);background:var(--hs-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-shop *,.higer-shop *::before,.higer-shop *::after{box-sizing:border-box}
.higer-shop :is(h1,h2,h3,h4,p,ul,ol,figure,table){margin:0;padding:0;border:0}
.higer-shop :is(h1,h2,h3,h4){font-family:inherit;color:inherit;letter-spacing:normal;text-transform:none;font-weight:900;line-height:1.5}
.higer-shop :is(ul,ol){list-style:none}
.higer-shop a{color:inherit;text-decoration:none;background:none}
.higer-shop button{font:inherit;color:inherit;background:none;border:0;border-radius:0;padding:0;margin:0;cursor:pointer;text-transform:none;letter-spacing:normal;box-shadow:none;line-height:inherit;min-height:0;width:auto;white-space:normal;text-align:inherit}
.higer-shop img{display:block;max-width:100%;height:auto;border:0}
.higer-shop svg{flex:none}
.higer-shop .hs-i{display:inline-block;vertical-align:middle}
.higer-shop [hidden]{display:none!important}
.higer-shop :focus-visible{outline:3px solid var(--hs-gold-600);outline-offset:3px}
.higer-shop .hs-wrap{width:100%;max-width:1320px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-shop .hs-wrap{padding-inline:24px}}
.higer-shop .hs-sr{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}

/* ---------- نشان‌ها و دکمه‌های مشترک ---------- */
.higer-shop .hs-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.78);color:var(--hs-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800;line-height:1.6}
.higer-shop .hs-kicker.is-dark{background:rgba(7,15,29,.55);color:var(--hs-gold-300);border-color:rgba(217,161,59,.4)}
.higer-shop .hs-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-shop :is(a,button).hs-btn-gold{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:8px;overflow:hidden;border:0;border-radius:9999px;padding:12px 22px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hs-navy-900);font-size:13px;font-weight:900;line-height:1.4;white-space:nowrap;box-shadow:0 10px 24px rgba(217,161,59,.35),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .2s,filter .2s}
.higer-shop :is(a,button).hs-btn-gold:is(:hover,:focus){background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hs-navy-900)}
.higer-shop :is(a,button).hs-btn-gold:hover{transform:translateY(-2px);filter:brightness(1.04)}
.higer-shop button.hs-btn-gold:disabled{cursor:not-allowed;opacity:.5;filter:grayscale(.5);transform:none;box-shadow:none}
.higer-shop .hs-badge{display:inline-grid;place-items:center;min-width:20px;height:20px;padding:0 6px;border-radius:9999px;background:var(--hs-gold-500);color:var(--hs-navy-900);font-size:11px;font-weight:900;line-height:1}

/* ---------- مسیر صفحه (داخل سربرگ و روی همان پس‌زمینه) و پیام‌ها ---------- */
.higer-shop .hs-crumbs{margin-bottom:32px;border-bottom:1px solid rgba(243,217,139,.16)}
@media(min-width:1024px){.higer-shop .hs-crumbs{margin-bottom:44px}}
.higer-shop .hs-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:rgba(250,247,239,.74)}
.higer-shop .hs-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-shop .hs-crumbs li+li::before{content:"‹";color:var(--hs-gold-500);font-weight:900}
.higer-shop .hs-crumbs a:hover{color:var(--hs-gold-300)}
.higer-shop .hs-crumbs [aria-current]{color:var(--hs-cream);font-weight:900}
.higer-shop .hs-crumbs-row{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px}
.higer-shop .hs-crumbs-row ol{flex:1;min-width:0}
.higer-shop a.hs-back-shop{display:inline-flex;flex:none;align-items:center;gap:6px;padding:5px 12px;border:1px solid rgba(243,217,139,.26);border-radius:9999px;background:rgba(7,15,29,.35);color:var(--hs-gold-300);font-size:11px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s,color .2s}
.higer-shop a.hs-back-shop:hover{border-color:var(--hs-gold-400);background:rgba(217,161,59,.2);color:#fff}
@media(max-width:639px){.higer-shop a.hs-back-shop{margin-bottom:10px}}
.higer-shop .hs-notices{padding-block:16px 8px}
.higer-shop .hs-notices :is(.woocommerce-message,.woocommerce-info,.woocommerce-error){display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin:0 0 8px;padding:14px 18px;border:1px solid var(--hs-line);border-radius:16px;background:#fff;font-size:13px;font-weight:700;box-shadow:0 10px 24px rgba(16,36,62,.06)}

/* ---------- سربرگ فروشگاه و نوار دسته‌بندی سریع ---------- */
.higer-shop .hs-hero{position:relative;overflow:hidden;padding-block:0 24px;background:radial-gradient(960px 440px at 85% -10%,rgba(217,161,59,.18),transparent 60%),radial-gradient(800px 420px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 48%,#16304f 100%);color:var(--hs-cream)}
@media(min-width:1024px){.higer-shop .hs-hero{padding-block:0 28px}}
.higer-shop .hs-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-shop .hs-hero>*{position:relative}
.higer-shop .hs-hero-grid{display:grid;gap:20px;align-items:center}
@media(min-width:1024px){.higer-shop .hs-hero-grid{grid-template-columns:minmax(0,1.5fr) minmax(0,320px)}}
.higer-shop .hs-hero-title{margin-top:12px;font-size:26px;line-height:1.4;color:#fff}
@media(min-width:640px){.higer-shop .hs-hero-title{font-size:34px}}
.higer-shop .hs-hero-sub{margin-top:8px;max-width:680px;font-size:13px;line-height:2;color:rgba(248,234,208,.85)}
.higer-shop a.hs-hero-finder{position:relative;display:flex;align-items:center;gap:12px;max-width:520px;margin-top:18px;padding:12px 14px;border:1.5px solid rgba(217,161,59,.6);border-radius:20px;background:radial-gradient(320px 130px at 92% 0%,rgba(217,161,59,.26),transparent 70%),linear-gradient(155deg,rgba(16,36,62,.9),rgba(24,50,80,.9));color:var(--hs-cream);box-shadow:0 14px 32px rgba(7,15,29,.35);transition:transform .22s,border-color .22s}
.higer-shop a.hs-hero-finder:hover{transform:translateY(-2px);border-color:var(--hs-gold-400);color:var(--hs-cream)}
.higer-shop .hs-hero-finder .hs-finder-ico{position:relative}
.higer-shop .hs-hero-finder .hs-finder-ico::after{content:"";position:absolute;top:-3px;right:-3px;width:9px;height:9px;border:2px solid #0b1a30;border-radius:50%;background:var(--hs-gold-300);animation:hs-finder-pulse 2.2s infinite}
@keyframes hs-finder-pulse{0%,100%{box-shadow:0 0 0 0 rgba(243,217,139,.75)}65%{box-shadow:0 0 0 7px rgba(243,217,139,0)}}
.higer-shop .hs-hero-finder .hs-finder-copy{flex:1;min-width:0}
.higer-shop .hs-hero-finder .hs-finder-copy b{display:block;font-size:13px;font-weight:900;color:var(--hs-gold-300)}
.higer-shop .hs-hero-finder .hs-finder-copy small{display:block;margin-top:2px;font-size:11px;font-weight:700;line-height:1.7;color:rgba(250,247,239,.85)}
.higer-shop .hs-hero-finder .hs-finder-go{display:inline-flex;flex:none;align-items:center;gap:3px;padding:6px 11px;border-radius:9999px;border:1px solid rgba(243,217,139,.45);background:rgba(217,161,59,.2);font-size:11px;font-weight:900;color:var(--hs-gold-300);transition:background .2s,color .2s}
.higer-shop .hs-hero-finder:hover .hs-finder-go{background:var(--hs-gold-500);border-color:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop .hs-hero-art{display:none}
@media(min-width:1024px){.higer-shop .hs-hero-art{display:flex;align-items:center;justify-content:center;padding:12px 18px;border:1px solid rgba(243,217,139,.2);border-radius:22px;background:rgba(7,15,29,.42);backdrop-filter:blur(8px)}}
.higer-shop .hs-hero-art .hs-core-svg{width:100%;max-width:260px;height:auto}
.higer-shop .hs-cat-strip-wrap{margin-top:22px}
.higer-shop .hs-cat-strip{display:flex;gap:8px;padding-bottom:4px;overflow-x:auto;scrollbar-width:none}
.higer-shop .hs-cat-strip::-webkit-scrollbar{display:none}
.higer-shop button.hs-cat-pill{display:inline-flex;flex:none;align-items:center;gap:8px;padding:8px 14px;border:1px solid rgba(243,217,139,.22);border-radius:9999px;background:rgba(7,15,29,.45);color:var(--hs-cream);font-size:12px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s,color .2s}
.higer-shop button.hs-cat-pill.is-sub{font-size:11px;opacity:.92}
.higer-shop button.hs-cat-pill:hover{border-color:rgba(243,217,139,.6);background:rgba(24,50,80,.75)}
.higer-shop button.hs-cat-pill[aria-pressed="true"]{border-color:var(--hs-gold-500);background:linear-gradient(180deg,#ecc470 0%,#d9a13b 60%,#c8892a 100%);color:var(--hs-navy-900);box-shadow:0 8px 20px rgba(217,161,59,.32)}
.higer-shop .hs-cat-pill span{display:inline-grid;place-items:center;min-width:20px;height:20px;padding:0 6px;border-radius:9999px;background:rgba(255,255,255,.12);font-size:10px;font-weight:900}
.higer-shop button.hs-cat-pill[aria-pressed="true"] span{background:rgba(16,36,62,.16);color:var(--hs-navy-900)}
.higer-shop a.hs-cat-pill{display:inline-flex;flex:none;align-items:center;gap:8px;padding:8px 14px;border:1px solid rgba(243,217,139,.22);border-radius:9999px;background:rgba(7,15,29,.45);color:var(--hs-cream);font-size:12px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s,color .2s}
.higer-shop a.hs-cat-pill:hover{border-color:rgba(243,217,139,.65);background:rgba(24,50,80,.78);color:#fff}
.higer-shop a.hs-cat-pill.is-active,.higer-shop a.hs-cat-pill[aria-current="page"]{border-color:var(--hs-gold-500);background:linear-gradient(180deg,#ecc470 0%,#d9a13b 60%,#c8892a 100%);color:var(--hs-navy-900);box-shadow:0 8px 20px rgba(217,161,59,.32)}
.higer-shop a.hs-cat-pill.is-active span,.higer-shop a.hs-cat-pill[aria-current="page"] span{background:rgba(16,36,62,.16);color:var(--hs-navy-900)}
.higer-shop a.hs-cat-pill.is-ghost{background:transparent;border-style:dashed;border-color:rgba(243,217,139,.34);color:var(--hs-gold-300)}
.higer-shop a.hs-cat-pill.is-ghost:hover{background:rgba(217,161,59,.14);border-style:solid;border-color:var(--hs-gold-400);color:#fff}

/* ---------- سربرگ اختصاصی صفحات دسته‌بندی (product_cat) ---------- */
.higer-shop .hs-hero.is-category{padding-block:0 28px;border-bottom:2px solid rgba(217,161,59,.35)}
@media(min-width:1024px){.higer-shop .hs-hero.is-category{padding-block:0 34px}}
.higer-shop .hs-hero.is-category::after{content:"";position:absolute;inset-inline:0;bottom:0;height:1px;background:linear-gradient(90deg,transparent,rgba(243,217,139,.55),transparent);pointer-events:none}
.higer-shop .hs-hero.is-category .hs-crumbs{margin-bottom:26px}
@media(min-width:1024px){.higer-shop .hs-hero.is-category .hs-crumbs{margin-bottom:36px}}
.higer-shop .hs-hero.is-theme-foam{background:radial-gradient(880px 440px at 14% 8%,rgba(98,146,96,.24),transparent 60%),radial-gradient(760px 380px at 88% -12%,rgba(217,161,59,.18),transparent 58%),linear-gradient(155deg,#081726 0%,#0f2737 52%,#143342 100%)}
.higer-shop .hs-hero.is-theme-rebond{background:radial-gradient(880px 440px at 14% 12%,rgba(196,132,54,.24),transparent 58%),radial-gradient(740px 380px at 88% -10%,rgba(231,185,92,.18),transparent 56%),linear-gradient(155deg,#0c1828 0%,#18263a 52%,#223145 100%)}
.higer-shop .hs-hero.is-theme-pocket{background:radial-gradient(860px 460px at 16% 10%,rgba(235,192,102,.24),transparent 58%),radial-gradient(780px 420px at 90% 105%,rgba(52,92,148,.34),transparent 56%),linear-gradient(155deg,#060f1f 0%,#0d203a 50%,#152d4f 100%)}
.higer-shop .hs-hero.is-theme-bonnell{background:radial-gradient(900px 440px at 84% -10%,rgba(217,161,59,.22),transparent 58%),radial-gradient(780px 420px at 8% 100%,rgba(49,92,142,.36),transparent 58%),linear-gradient(155deg,#0a192e 0%,#112744 50%,#18365b 100%)}
.higer-shop .hs-hero.is-theme-accessory{background:radial-gradient(820px 420px at 15% 12%,rgba(243,217,139,.18),transparent 58%),radial-gradient(720px 420px at 88% 100%,rgba(74,118,146,.28),transparent 58%),linear-gradient(155deg,#0d1f30 0%,#162f46 52%,#1e3d56 100%)}
.higer-shop .hs-hero.is-theme-mattress{background:radial-gradient(900px 440px at 18% 0%,rgba(217,161,59,.22),transparent 58%),radial-gradient(780px 420px at 88% 105%,rgba(43,78,119,.36),transparent 58%),linear-gradient(155deg,#081526 0%,#10243e 48%,#183556 100%)}
.higer-shop .hs-hero.is-category .hs-hero-grid{gap:24px}
@media(min-width:1024px){.higer-shop .hs-hero.is-category .hs-hero-grid{grid-template-columns:minmax(0,1.45fr) minmax(0,360px);gap:36px}}
.higer-shop .hs-hero.is-category .hs-hero-title{font-size:28px;line-height:1.38}
@media(min-width:640px){.higer-shop .hs-hero.is-category .hs-hero-title{font-size:38px}}
.higer-shop .hs-hero.is-category .hs-hero-sub{margin-top:10px;max-width:660px;font-size:13.5px;line-height:2.05;color:rgba(250,247,239,.86)}
.higer-shop .hs-cat-traits{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px}
.higer-shop .hs-cat-traits li{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border:1px solid rgba(243,217,139,.24);border-radius:9999px;background:rgba(7,15,29,.36);font-size:11.5px;font-weight:700;color:var(--hs-gold-200)}
.higer-shop .hs-cat-traits li .hs-i{color:var(--hs-gold-400)}
.higer-shop .hs-cat-stats{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1px;margin-top:20px;max-width:640px;overflow:hidden;border:1px solid rgba(243,217,139,.2);border-radius:16px;background:rgba(243,217,139,.14)}
@media(min-width:640px){.higer-shop .hs-cat-stats{grid-template-columns:repeat(auto-fit,minmax(120px,1fr))}}
.higer-shop .hs-cat-stat{padding:11px 14px;background:rgba(7,15,29,.52);backdrop-filter:blur(6px)}
.higer-shop .hs-cat-stat small{display:block;font-size:10px;font-weight:700;color:rgba(248,234,208,.68)}
.higer-shop .hs-cat-stat b{display:block;margin-top:2px;font-size:13px;font-weight:900;color:#fff;line-height:1.5}
.higer-shop .hs-hero-art.is-cat{display:none;flex-direction:column;align-items:stretch;justify-content:flex-start;gap:12px;padding:18px;border:1px solid rgba(243,217,139,.28);border-radius:24px;background:radial-gradient(280px 180px at 50% 0%,rgba(243,217,139,.12),transparent 75%),rgba(7,15,29,.5);box-shadow:0 24px 52px rgba(4,10,20,.38);backdrop-filter:blur(10px)}
@media(min-width:1024px){.higer-shop .hs-hero-art.is-cat{display:flex}}
.higer-shop .hs-hero-art.is-cat .hs-cat-art-stage{display:flex;align-items:center;justify-content:center;width:100%;aspect-ratio:16/10;overflow:hidden;border-radius:16px;border:1px solid rgba(243,217,139,.14);background:rgba(7,15,29,.42);padding:12px}
.higer-shop .hs-hero-art.is-cat .hs-cat-art-stage.has-img{padding:0}
.higer-shop .hs-hero-art.is-cat .hs-cat-art-stage img{width:100%;height:100%;object-fit:cover}
.higer-shop .hs-hero-art.is-cat .hs-core-svg{width:100%;max-width:290px;height:auto}
.higer-shop .hs-cat-art-cap{display:flex;align-items:center;justify-content:space-between;gap:8px;font-size:11px;font-weight:800;color:var(--hs-gold-300)}
.higer-shop a.hs-cat-finder-mini{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:9px 12px;border:1px solid rgba(217,161,59,.42);border-radius:14px;background:rgba(217,161,59,.14);color:var(--hs-gold-200);font-size:11px;font-weight:800;line-height:1.6;transition:background .2s,border-color .2s,color .2s}
.higer-shop a.hs-cat-finder-mini:hover{background:var(--hs-gold-500);border-color:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop a.hs-cat-finder-mini>span{display:inline-flex;align-items:center;gap:6px;min-width:0}
.higer-shop .hs-cat-strip-label{display:inline-flex;flex:none;align-items:center;font-size:11px;font-weight:800;color:rgba(248,234,208,.72);padding-inline-end:4px;white-space:nowrap}
.higer-shop .hs-cat-nav-row{display:flex;align-items:center;gap:8px;padding-top:16px;margin-top:22px;border-top:1px solid rgba(243,217,139,.14);overflow-x:auto;scrollbar-width:none}
.higer-shop .hs-cat-nav-row::-webkit-scrollbar{display:none}
.higer-shop a.hs-cat-row{display:flex;align-items:center;gap:8px;width:100%;padding:7px 8px;border-radius:10px;font-size:12px;font-weight:700;color:var(--hs-navy-800);transition:background .15s,color .15s}
.higer-shop a.hs-cat-row:hover{background:var(--hs-cream);color:var(--hs-navy-900)}
.higer-shop a.hs-cat-row[aria-current="page"]{background:#fdf3d8;font-weight:900;color:var(--hs-navy-900)}
.higer-shop a.hs-cat-row[aria-current="page"] .hs-radio{border-color:var(--hs-gold-600);background:var(--hs-gold-500);box-shadow:inset 0 0 0 3px #fff}
.higer-shop a.hs-cat-all-link{display:flex;align-items:center;justify-content:space-between;gap:6px;margin-top:10px;padding:8px 10px;border-top:1px dashed var(--hs-line);font-size:11px;font-weight:800;color:var(--hs-gold-600)}
.higer-shop a.hs-cat-all-link:hover{color:var(--hs-navy-900)}
.higer-shop .hs-cat-guide-sec{padding:0 0 48px;background:var(--hs-paper)}
.higer-shop .hs-cat-guide{padding:24px;border:1px solid var(--hs-line);border-radius:24px;background:#fff;box-shadow:0 12px 30px rgba(16,36,62,.05)}
@media(min-width:640px){.higer-shop .hs-cat-guide{padding:32px 36px}}
.higer-shop .hs-cat-guide h2.hs-cat-guide-title{margin:10px 0 0;font-size:20px;font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-cat-guide-body{position:relative;margin-top:14px;font-size:14px;line-height:2.1;color:var(--hs-navy-700)}
.higer-shop .hs-cat-guide-body :is(p,ul,ol){margin:0 0 12px}
.higer-shop .hs-cat-guide-body ul{padding-inline-start:22px;list-style:disc}
.higer-shop .hs-cat-guide-body ol{padding-inline-start:22px;list-style:decimal}
.higer-shop .hs-cat-guide-body :is(h2,h3){margin:20px 0 8px;font-size:17px;font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-cat-guide-body a{color:var(--hs-gold-600);text-decoration:underline;text-underline-offset:3px}
.higer-shop .hs-cat-guide-body.is-clamped{max-height:220px;overflow:hidden}
.higer-shop .hs-cat-guide-body.is-clamped::after{content:"";position:absolute;inset-inline:0;bottom:0;height:84px;background:linear-gradient(to bottom,rgba(255,255,255,0),#fff 90%);pointer-events:none}
.higer-shop button.hs-cat-guide-btn{display:inline-flex;align-items:center;gap:6px;margin-top:14px;padding:9px 18px;border:1.5px solid var(--hs-line);border-radius:9999px;background:var(--hs-cream);font-size:12px;font-weight:900;color:var(--hs-navy-900);transition:border-color .2s,background .2s}
.higer-shop button.hs-cat-guide-btn:hover{border-color:var(--hs-gold-500);background:#fdf3d8}
.higer-shop button.hs-cat-guide-btn[aria-expanded="true"] .hs-i{transform:rotate(180deg)}
.higer-shop button.hs-cat-guide-btn .hs-i{transition:transform .2s}
.higer-shop-archive-main{display:block;width:100%;margin:0;padding:0;overflow-x:clip}

/* ---------- نوار ابزار موبایل ---------- */
.higer-shop .hs-mobile-bar{position:sticky;top:var(--hs-sticky-top,var(--wp-admin--admin-bar--height,0px));z-index:38;border-bottom:1px solid var(--hs-line);background:rgba(250,247,239,.96);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:top .15s ease}
@media(min-width:1024px){.higer-shop .hs-mobile-bar{display:none}}
.higer-shop .hs-mobile-bar-inner{display:flex;align-items:center;gap:10px;padding-block:10px}
.higer-shop button.hs-mobile-filter-btn{display:inline-flex;flex:none;align-items:center;gap:8px;padding:9px 14px;border:1.5px solid var(--hs-navy-900);border-radius:9999px;background:var(--hs-navy-900);color:var(--hs-gold-300);font-size:12px;font-weight:900}
.higer-shop .hs-mobile-sort{flex:1;min-width:0}
.higer-shop .hs-mobile-sort select{width:100%;height:40px;padding:0 12px;border:1.5px solid var(--hs-line);border-radius:9999px;background:#fff;font:inherit;font-size:12px;font-weight:800;color:var(--hs-navy-900)}

/* ---------- چیدمان دو ستونه اصلی ---------- */
.higer-shop .hs-main{padding-block:28px 64px;background-color:var(--hs-paper);background-image:radial-gradient(ellipse 80% 50% at 80% 0%,rgba(217,161,59,.1),transparent),radial-gradient(ellipse 60% 50% at 0% 100%,rgba(16,36,62,.06),transparent)}
@media(min-width:1024px){.higer-shop .hs-main{padding-block:36px 84px}}
.higer-shop .hs-layout{display:grid;gap:28px;align-items:start}
@media(min-width:1024px){.higer-shop .hs-layout{grid-template-columns:310px minmax(0,1fr)}}

/* ---------- سایدبار فیلترها (دسکتاپ چسبنده + موبایل دراور) ---------- */
.higer-shop .hs-backdrop{position:fixed;inset:0;z-index:9990;background:rgba(7,15,29,.62);backdrop-filter:blur(3px)}
.higer-shop .hs-sidebar{border:1px solid var(--hs-line);border-radius:24px;background:#fff;box-shadow:0 18px 44px rgba(16,36,62,.08)}
@media(min-width:1024px){
  .higer-shop .hs-sidebar{position:sticky;top:calc(var(--hs-sticky-top,var(--wp-admin--admin-bar--height,0px)) + 16px);max-height:calc(100vh - var(--hs-sticky-top,0px) - 32px);display:flex;flex-direction:column;overflow:hidden}
  .higer-shop .hs-sidebar-body{overflow-y:auto;scrollbar-width:thin}
  .higer-shop .hs-drawer-close,.higer-shop .hs-sidebar-foot{display:none!important}
}
@media(max-width:1023px){
  .higer-shop .hs-sidebar{position:fixed;top:var(--hs-drawer-top,var(--hs-sticky-top,var(--wp-admin--admin-bar--height,0px)));right:0;bottom:0;z-index:9995;display:flex;flex-direction:column;overflow:hidden;width:min(90vw,380px);border-radius:24px 0 0 24px;box-shadow:-20px 0 50px rgba(7,15,29,.45);transform:translateX(105%);visibility:hidden;transition:transform .28s cubic-bezier(.22,1,.36,1),visibility .28s,top .15s ease}
  .higer-shop .hs-sidebar.is-open{transform:none;visibility:visible}
  .higer-shop .hs-sidebar-body{flex:1;min-height:0;overflow-y:auto;-webkit-overflow-scrolling:touch}
}
.higer-shop .hs-sidebar-head{display:flex;flex-direction:column;gap:10px;padding:14px 16px;border-bottom:1px solid var(--hs-line);background:var(--hs-cream);position:sticky;top:0;z-index:6}
.higer-shop .hs-sidebar-title{display:flex;align-items:center;gap:8px;color:var(--hs-navy-900)}
.higer-shop .hs-sidebar-title h2{flex:1;font-size:15px;font-weight:900}
.higer-shop button.hs-reset-link{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:800;color:var(--hs-bad)}
.higer-shop button.hs-reset-link:hover{text-decoration:underline}
.higer-shop button.hs-drawer-close{display:grid;place-items:center;width:34px;height:34px;border-radius:50%;background:#fff;border:1px solid var(--hs-line);color:var(--hs-navy-900)}
.higer-shop .hs-sidebar-foot{padding:12px 16px;border-top:1px solid var(--hs-line);background:var(--hs-cream)}
.higer-shop .hs-drawer-apply{width:100%}

/* گروه‌های فیلتر */
.higer-shop .hs-fgroup{border-bottom:1px solid var(--hs-line)}
.higer-shop .hs-fgroup:last-of-type{border-bottom:0}
.higer-shop .hs-fgroup-plain{padding:16px 18px}
.higer-shop .hs-fgroup{border-bottom:0;margin:10px 12px;border:1px solid var(--hs-line);border-radius:16px;background:#fffdf6;overflow:hidden}
.higer-shop .hs-fgroup:first-of-type{margin-top:12px}
.higer-shop .hs-fgroup>summary{position:relative;display:flex;align-items:center;justify-content:space-between;gap:8px;padding:11px 14px;font-size:13px;font-weight:900;color:var(--hs-navy-900);list-style:none;cursor:pointer;user-select:none;background:linear-gradient(270deg,rgba(217,161,59,.14),rgba(255,253,246,.4));border-right:3px solid var(--hs-gold-500);transition:background .2s}
.higer-shop .hs-fgroup>summary::-webkit-details-marker{display:none}
.higer-shop .hs-fgroup[open]>summary{background:linear-gradient(270deg,rgba(217,161,59,.2),rgba(255,253,246,.6));border-right-color:var(--hs-gold-600)}
.higer-shop .hs-fgroup>summary:hover{background:linear-gradient(270deg,rgba(217,161,59,.24),rgba(255,253,246,.8))}
.higer-shop .hs-fgroup>summary>span{display:inline-flex;align-items:center;gap:7px}
.higer-shop .hs-fgroup>summary>span .hs-i{color:var(--hs-navy-900);background:var(--hs-gold-500);border-radius:8px;padding:3px}
.higer-shop .hs-fgroup>summary>.hs-i{color:var(--hs-navy-600);transition:transform .2s}
.higer-shop .hs-fgroup[open]>summary>.hs-i{transform:rotate(180deg)}
.higer-shop .hs-fhint{font-size:10px;font-weight:700;color:var(--hs-gold-600)}
.higer-shop .hs-fbody{padding:0 18px 16px}

/* جستجو و سوییچ‌ها */
.higer-shop .hs-search{display:flex;align-items:center;gap:8px;padding:0 12px;border:1.5px solid var(--hs-line);border-radius:14px;background:var(--hs-cream);transition:border-color .2s,background .2s}
.higer-shop .hs-search:focus-within{border-color:var(--hs-gold-500);background:#fff}
.higer-shop .hs-search>.hs-i{color:var(--hs-navy-600)}
.higer-shop .hs-search input[type="search"]{flex:1;min-width:0;height:40px;border:0;background:transparent;font:inherit;font-size:12px;font-weight:700;color:var(--hs-navy-900);outline:none}
.higer-shop .hs-search input[type="search"]::-webkit-search-cancel-button{display:none}
.higer-shop button.hs-search-clear{display:grid;place-items:center;width:24px;height:24px;border-radius:50%;background:rgba(16,36,62,.08);color:var(--hs-navy-800)}
.higer-shop .hs-toggles{display:grid;gap:10px;margin-top:14px}
.higer-shop .hs-switch{display:flex;align-items:center;gap:10px;font-size:12px;font-weight:800;color:var(--hs-navy-800);cursor:pointer}
.higer-shop .hs-switch input{position:absolute;opacity:0;pointer-events:none}
.higer-shop .hs-switch-ui{position:relative;flex:none;width:38px;height:22px;border-radius:9999px;background:#d8d2c1;transition:background .2s}
.higer-shop .hs-switch-ui::after{content:"";position:absolute;top:3px;right:3px;width:16px;height:16px;border-radius:50%;background:#fff;box-shadow:0 2px 5px rgba(0,0,0,.2);transition:transform .2s}
.higer-shop .hs-switch input:checked+.hs-switch-ui{background:var(--hs-gold-500)}
.higer-shop .hs-switch input:checked+.hs-switch-ui::after{transform:translateX(-16px)}
.higer-shop .hs-switch input:focus-visible+.hs-switch-ui{outline:2px solid var(--hs-navy-900);outline-offset:2px}

/* گرید انتخاب سایز در فیلتر */
.higer-shop .hs-size-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:6px}
.higer-shop button.hs-size-chip{position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:56px;padding:6px 4px;border:1.5px solid var(--hs-line);border-radius:12px;background:#fffdf6;text-align:center;transition:border-color .2s,background .2s,transform .15s}
.higer-shop button.hs-size-chip:hover{border-color:rgba(217,161,59,.7);transform:translateY(-1px)}
.higer-shop button.hs-size-chip[aria-pressed="true"]{border-color:var(--hs-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);box-shadow:0 8px 18px rgba(217,161,59,.24),inset 0 0 0 1px rgba(217,161,59,.4)}
.higer-shop button.hs-size-chip.is-zero:not([aria-pressed="true"]){opacity:.38}
.higer-shop .hs-size-chip b{font-size:12px;font-weight:900;line-height:1.4;color:var(--hs-navy-900)}
.higer-shop .hs-size-chip small{font-size:9px;font-weight:700;color:var(--hs-navy-600)}
.higer-shop .hs-size-chip em{font-size:9px;font-style:normal;font-weight:800;color:var(--hs-gold-600)}

/* اسلایدر دوطرفه قیمت */
.higer-shop .hs-price-readout{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:8px 10px;border:1px solid var(--hs-line);border-radius:12px;background:var(--hs-cream);font-size:11px;font-weight:700;color:var(--hs-navy-700)}
.higer-shop .hs-price-readout b{font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-range-dual{position:relative;height:30px;margin-top:12px;direction:rtl}
.higer-shop .hs-range-track{position:absolute;top:50%;left:0;right:0;height:6px;transform:translateY(-50%);border-radius:9999px;background:var(--hs-line);overflow:hidden}
.higer-shop .hs-range-track span{position:absolute;top:0;bottom:0;background:linear-gradient(270deg,#ecc470,#c8892a);border-radius:9999px}
.higer-shop .hs-range-dual input[type="range"]{position:absolute;top:0;left:0;width:100%;height:30px;margin:0;background:none;pointer-events:none;-webkit-appearance:none;appearance:none}
.higer-shop .hs-range-dual input[type="range"]::-webkit-slider-thumb{width:20px;height:20px;border:2.5px solid var(--hs-navy-900);border-radius:50%;background:var(--hs-gold-400);box-shadow:0 3px 8px rgba(16,36,62,.3);pointer-events:auto;cursor:pointer;-webkit-appearance:none;appearance:none}
.higer-shop .hs-range-dual input[type="range"]::-moz-range-thumb{width:18px;height:18px;border:2.5px solid var(--hs-navy-900);border-radius:50%;background:var(--hs-gold-400);box-shadow:0 3px 8px rgba(16,36,62,.3);pointer-events:auto;cursor:pointer}
.higer-shop button.hs-price-reset{display:none;align-items:center;gap:5px;margin-top:10px;padding:6px 11px;border:1px solid var(--hs-line);border-radius:10px;background:#fff;font-size:10px;font-weight:800;color:var(--hs-navy-700)}
.higer-shop button.hs-price-reset:hover{border-color:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop button.hs-price-reset.is-visible{display:inline-flex}
.higer-shop .hs-presets{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:6px;margin-top:10px}
.higer-shop button.hs-preset{padding:6px 8px;border:1px solid var(--hs-line);border-radius:10px;background:#fffdf6;font-size:10px;font-weight:800;color:var(--hs-navy-700);text-align:center;transition:border-color .2s,background .2s}
.higer-shop button.hs-preset:hover{border-color:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop button.hs-preset.is-on{border-color:var(--hs-gold-500);background:#fdf3d8;color:var(--hs-navy-900)}

/* درخت دسته‌بندی و چک‌لیست ویژگی‌ها */
.higer-shop .hs-cat-tree,.higer-shop .hs-check-list{display:grid;gap:4px}
.higer-shop .hs-cat-tree li{padding-right:calc(var(--depth,0) * 14px)}
.higer-shop button.hs-cat-row,.higer-shop button.hs-check-row{display:flex;align-items:center;gap:9px;width:100%;padding:8px 10px;border:1px solid transparent;border-radius:12px;font-size:12px;font-weight:800;color:var(--hs-navy-800);transition:background .15s,border-color .15s}
.higer-shop button.hs-cat-row:hover,.higer-shop button.hs-check-row:hover{background:var(--hs-cream)}
.higer-shop button.hs-cat-row[aria-pressed="true"],.higer-shop button.hs-check-row[aria-pressed="true"]{border-color:rgba(217,161,59,.55);background:linear-gradient(160deg,#fffdf3,#fdf3d8);color:var(--hs-navy-900)}
.higer-shop button.hs-cat-row.is-zero:not([aria-pressed="true"]),.higer-shop button.hs-check-row.is-zero:not([aria-pressed="true"]),.higer-shop button.hs-fpill.is-zero:not([aria-pressed="true"]){opacity:.38}
.higer-shop .hs-radio{display:grid;flex:none;place-items:center;width:16px;height:16px;border:1.5px solid #bfb8a5;border-radius:50%;background:#fff}
.higer-shop button.hs-cat-row[aria-pressed="true"] .hs-radio{border-color:var(--hs-navy-900);background:var(--hs-navy-900);box-shadow:inset 0 0 0 3px var(--hs-gold-400)}
.higer-shop .hs-box{display:grid;flex:none;place-items:center;width:18px;height:18px;border:1.5px solid #bfb8a5;border-radius:6px;background:#fff;color:transparent;transition:background .15s,border-color .15s,color .15s}
.higer-shop button.hs-check-row[aria-pressed="true"] .hs-box{border-color:var(--hs-navy-900);background:var(--hs-navy-900);color:var(--hs-gold-300)}
.higer-shop .hs-cat-name,.higer-shop .hs-check-label{display:flex;flex:1;align-items:center;justify-content:space-between;gap:6px;min-width:0}
.higer-shop .hs-fcount{flex:none;font-size:11px;font-style:normal;font-weight:800;color:var(--hs-navy-600)}
.higer-shop .hs-pill-list{display:flex;flex-wrap:wrap;gap:6px}
.higer-shop button.hs-fpill{display:inline-flex;align-items:center;gap:5px;padding:7px 12px;border:1.5px solid var(--hs-line);border-radius:9999px;background:#fffdf6;font-size:12px;font-weight:800;color:var(--hs-navy-800);transition:border-color .2s,background .2s}
.higer-shop button.hs-fpill:hover{border-color:rgba(217,161,59,.7)}
.higer-shop button.hs-fpill[aria-pressed="true"]{border-color:var(--hs-gold-500);background:#fdf3d8;color:var(--hs-navy-900)}
.higer-shop .hs-fpill em{font-size:10px;font-style:normal;font-weight:800;color:var(--hs-gold-600)}
.higer-shop .hs-mini-meter{display:inline-flex;gap:3px;vertical-align:middle}
.higer-shop .hs-mini-meter i{width:11px;height:4px;border-radius:9999px;background:var(--hs-line)}
.higer-shop .hs-mini-meter i.is-on{background:var(--hs-gold-500)}

/* کارت تشک‌سنج در سایدبار و هیرو */
.higer-shop a.hs-finder-cta{display:flex;align-items:center;gap:10px;margin:12px;padding:12px;border:1.5px solid rgba(217,161,59,.55);border-radius:18px;background:radial-gradient(240px 100px at 90% 0%,rgba(217,161,59,.22),transparent 70%),linear-gradient(155deg,#0b1a30 0%,#10243e 55%,#183250 100%);color:var(--hs-cream);box-shadow:0 12px 26px rgba(16,36,62,.18);transition:transform .2s,border-color .2s}
.higer-shop a.hs-finder-cta:hover{transform:translateY(-2px);border-color:var(--hs-gold-400);color:var(--hs-cream)}
.higer-shop .hs-finder-ico{position:relative;display:grid;flex:none;place-items:center;width:40px;height:40px;border-radius:12px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 65%,#c8892a 100%);color:var(--hs-navy-900)}
.higer-shop .hs-finder-copy{flex:1;min-width:0}
.higer-shop .hs-finder-copy b{display:block;font-size:12px;font-weight:900;color:var(--hs-gold-300)}
.higer-shop .hs-finder-copy small{display:block;margin-top:2px;font-size:10px;font-weight:700;line-height:1.6;color:rgba(250,247,239,.82)}
.higer-shop .hs-finder-go{display:inline-flex;flex:none;align-items:center;gap:2px;font-size:11px;font-weight:900;color:var(--hs-gold-300)}

/* ---------- نوار ابزار بالا و چیپ‌های فیلتر فعال ---------- */
.higer-shop .hs-content{min-width:0}
.higer-shop .hs-toolbar{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px;padding:12px 16px;border:1px solid var(--hs-line);border-radius:18px;background:#fff;box-shadow:0 8px 22px rgba(16,36,62,.05)}
.higer-shop .hs-result-meta{display:flex;flex-wrap:wrap;align-items:center;gap:8px;font-size:13px;font-weight:700;color:var(--hs-navy-700)}
.higer-shop .hs-result-meta b{font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-size-banner{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:9999px;background:#fdf3d8;border:1px solid rgba(217,161,59,.5);font-size:11px;font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-toolbar-end{display:none;align-items:center;gap:10px}
@media(min-width:1024px){.higer-shop .hs-toolbar-end{display:flex}}
.higer-shop .hs-sort-box{display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:800;color:var(--hs-navy-700)}
.higer-shop .hs-sort-box select{height:38px;padding:0 12px;border:1.5px solid var(--hs-line);border-radius:9999px;background:var(--hs-cream);font:inherit;font-size:12px;font-weight:800;color:var(--hs-navy-900)}
.higer-shop .hs-view-switch{display:inline-flex;padding:3px;border:1px solid var(--hs-line);border-radius:12px;background:var(--hs-cream)}
.higer-shop .hs-view-switch button{display:grid;place-items:center;width:32px;height:32px;border-radius:9px;color:var(--hs-navy-600)}
.higer-shop .hs-view-switch button[aria-pressed="true"]{background:var(--hs-navy-900);color:var(--hs-gold-300)}

/* نوار فیلترهای فعال بالای محصولات — چسبنده فقط در تبلت و دسکتاپ (≥۷۶۸px) */
.higer-shop .hs-active-bar{position:relative;z-index:35;margin-bottom:16px;padding:10px 12px;border:1px dashed rgba(217,161,59,.6);border-radius:16px;background:rgba(255,253,246,.96);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);box-shadow:0 10px 26px rgba(16,36,62,.08)}
@media(min-width:768px){
  .higer-shop .hs-active-bar{position:sticky;top:calc(var(--hs-sticky-top,var(--wp-admin--admin-bar--height,0px)) + var(--hs-mbar-h,61px) + 10px);transition:top .15s ease}
}
@media(min-width:1024px){
  .higer-shop .hs-active-bar{top:calc(var(--hs-sticky-top,var(--wp-admin--admin-bar--height,0px)) + 16px)}
}

/* فیلترهای فعال داخل سایدبار — فقط موبایل (<۷۶۸px) و چسبنده بالای دراور */
@media(min-width:768px){
  .higer-shop .hs-sidebar-head .hs-active-chips,
  .higer-shop .hs-sidebar-head .hs-reset-link,
  .higer-shop .hs-sidebar-head .hs-reset-link.is-visible{display:none!important}
}
@media(max-width:767px){
  .higer-shop .hs-sidebar-head{flex:none;position:sticky;top:0;z-index:6;box-shadow:0 8px 18px rgba(16,36,62,.06)}
  .higer-shop .hs-sidebar-head .hs-active-chips{max-height:92px;overflow-y:auto;scrollbar-width:thin;overscroll-behavior:contain}
  .higer-shop .hs-sidebar-head .hs-active-chips:empty{display:none}
  .higer-shop .hs-sidebar-head .hs-reset-link.is-visible{margin-top:0;align-self:flex-start}
}
.higer-shop .hs-active-bar-inner{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:8px}
.higer-shop .hs-active-chips{display:flex;flex-wrap:wrap;gap:6px}
.higer-shop button.hs-chip{display:inline-flex;align-items:center;gap:6px;padding:5px 11px;border:1px solid rgba(217,161,59,.55);border-radius:9999px;background:#fdf3d8;font-size:11px;font-weight:800;color:var(--hs-navy-900);transition:background .15s}
.higer-shop button.hs-chip:hover{background:var(--hs-gold-400)}
.higer-shop button.hs-clear-all{flex:none;font-size:11px;font-weight:900;color:var(--hs-bad)}
.higer-shop button.hs-clear-all:hover{text-decoration:underline}
.higer-shop button.hs-reset-link{display:none;align-items:center;gap:5px;margin-top:10px;padding:7px 12px;border-radius:12px;background:#fff;border:1px solid #fca5a5;font-size:11px;font-weight:800;color:var(--hs-bad)}
.higer-shop button.hs-reset-link:hover{background:#fef2f2}
.higer-shop button.hs-reset-link.is-visible{display:inline-flex}

/* ---------- شبکه و کارت محصولات ---------- */
.higer-shop .hs-grid{display:grid;grid-template-columns:minmax(0,1fr);gap:16px}
@media(min-width:560px){.higer-shop .hs-grid[data-view="grid"]{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(min-width:1180px){.higer-shop .hs-grid[data-view="grid"]{grid-template-columns:repeat(3,minmax(0,1fr));gap:20px}}
.higer-shop .hs-card{display:flex;flex-direction:column;overflow:hidden;border:1px solid var(--hs-line);border-radius:22px;background:#fff;box-shadow:0 12px 30px rgba(16,36,62,.06);transition:transform .25s,box-shadow .25s,border-color .25s}
.higer-shop .hs-card:hover{transform:translateY(-4px);border-color:rgba(217,161,59,.6);box-shadow:0 22px 46px rgba(16,36,62,.14)}
.higer-shop .hs-card.is-out{opacity:.78}
.higer-shop .hs-card-media{position:relative;aspect-ratio:4/3;overflow:hidden;background:radial-gradient(400px 200px at 85% 0%,rgba(217,161,59,.18),transparent 65%),linear-gradient(160deg,#0b1a30 0%,#10243e 55%,#16304f 100%)}
.higer-shop .hs-card-img-link{display:block;width:100%;height:100%}
.higer-shop .hs-card-media img{width:100%;height:100%;object-fit:cover;transition:transform .45s ease}
.higer-shop .hs-card:hover .hs-card-media img{transform:scale(1.04)}
.higer-shop .hs-card-svg-wrap{display:flex;align-items:center;justify-content:center;width:100%;height:100%;padding:24px}
.higer-shop .hs-card-svg-wrap .hs-core-svg{width:100%;max-width:240px;height:auto}
.higer-shop .hs-card-badges{position:absolute;top:12px;right:12px;z-index:2;display:flex;flex-wrap:wrap;gap:5px;max-width:calc(100% - 96px)}
.higer-shop .hs-pill-cat,.higer-shop .hs-pill-war,.higer-shop .hs-pill-out,.higer-shop .hs-pill-sale{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:9999px;font-size:10px;font-weight:800;backdrop-filter:blur(8px)}
.higer-shop .hs-pill-cat{background:rgba(7,15,29,.72);border:1px solid rgba(243,217,139,.35);color:var(--hs-gold-300)}
.higer-shop .hs-pill-war{background:rgba(255,253,246,.92);color:var(--hs-navy-900)}
.higer-shop .hs-pill-out{background:#fee2e2;color:var(--hs-bad)}
.higer-shop .hs-pill-sale{background:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop button.hs-card-cmp-ico{position:absolute;top:12px;left:12px;z-index:2;display:inline-flex;align-items:center;padding:5px 10px;border:1px solid rgba(255,255,255,.32);border-radius:9999px;background:rgba(7,15,29,.66);color:#fff;font-size:10px;font-weight:800;backdrop-filter:blur(8px);transition:background .2s,color .2s,border-color .2s}
.higer-shop button.hs-card-cmp-ico:hover{border-color:var(--hs-gold-400);color:var(--hs-gold-300)}
.higer-shop button.hs-card-cmp-ico[aria-pressed="true"]{border-color:var(--hs-gold-500);background:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop [data-hs-cmp] :is(.hs-cmp-off,.hs-cmp-on){display:inline-flex;align-items:center;gap:4px}
.higer-shop [data-hs-cmp] .hs-cmp-on{display:none}
.higer-shop [data-hs-cmp][aria-pressed="true"] .hs-cmp-on{display:inline-flex}
.higer-shop [data-hs-cmp][aria-pressed="true"] .hs-cmp-off{display:none}

.higer-shop .hs-card-body{display:flex;flex:1;flex-direction:column;gap:12px;padding:16px}
.higer-shop .hs-card-head{display:flex;flex-direction:column;gap:4px;padding-bottom:12px;border-bottom:1px solid var(--hs-line)}
.higer-shop .hs-card-head h2.hs-card-title{margin:0;padding:0;font-size:19px;font-weight:900;line-height:1.45;letter-spacing:-.15px;color:var(--hs-navy-900)}
.higer-shop .hs-card-title a{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden;color:inherit;text-decoration:underline;text-decoration-color:transparent;text-decoration-thickness:2px;text-underline-offset:5px;transition:color .2s,text-decoration-color .2s}
.higer-shop .hs-card-title a:hover,.higer-shop .hs-card-title a:focus-visible{color:var(--hs-navy-700);text-decoration-color:var(--hs-gold-500)}
@media(min-width:1024px){.higer-shop .hs-card-head h2.hs-card-title{font-size:21px}}
.higer-shop .hs-card-head p.hs-card-sub{margin:0;padding:0;font-size:12px;font-weight:600;line-height:1.65;color:#6b7686;display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:1;overflow:hidden}
.higer-shop .hs-card-specs{display:flex;flex-wrap:wrap;gap:5px}
.higer-shop .hs-card-specs li{display:inline-flex;align-items:center;gap:4px;padding:4px 8px;border-radius:9px;background:var(--hs-paper);font-size:10px;font-weight:800;line-height:1.6;color:var(--hs-navy-800)}
.higer-shop .hs-card-specs li .hs-i{color:var(--hs-gold-600)}
.higer-shop .hs-card-specs li.is-accent{background:#fdf3d8;border:1px solid rgba(217,161,59,.35)}
.higer-shop .hs-card-specs .hs-mini-meter i{width:8px;height:4px}

.higer-shop .hs-card-price-box{margin-top:auto;padding:10px 12px;border:1px solid var(--hs-line);border-radius:14px;background:var(--hs-cream)}
.higer-shop .hs-card-price-box small{display:block;font-size:10px;font-weight:800;color:var(--hs-navy-600)}
.higer-shop .hs-card-price-row{display:flex;flex-wrap:wrap;align-items:baseline;gap:6px;margin-top:1px}
.higer-shop .hs-card-price-row strong{font-size:15px;font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-card-price-row del{font-size:11px;color:#8a94a3}

.higer-shop .hs-card-actions{display:grid;grid-template-columns:minmax(0,1.25fr) minmax(0,1fr);gap:8px}
.higer-shop .hs-card-actions>:only-child{grid-column:1/-1}
.higer-shop a.hs-btn-primary{display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:10px 12px;border-radius:12px;background:var(--hs-navy-900);color:var(--hs-gold-300);font-size:12px;font-weight:900;white-space:nowrap;transition:background .2s,color .2s}
.higer-shop a.hs-btn-primary:hover{background:var(--hs-gold-500);color:var(--hs-navy-900)}
.higer-shop :is(a,button).hs-btn-sec{display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:10px 10px;border:1px solid var(--hs-line);border-radius:12px;background:#fff;color:var(--hs-navy-800);font-size:11px;font-weight:800;white-space:nowrap;transition:border-color .2s,background .2s}
.higer-shop :is(a,button).hs-btn-sec:hover{border-color:var(--hs-gold-500);background:var(--hs-cream);color:var(--hs-navy-900)}

/* حالت نمایش فهرستی در دسکتاپ */
@media(min-width:768px){
  .higer-shop .hs-grid[data-view="list"] .hs-card{flex-direction:row;align-items:stretch}
  .higer-shop .hs-grid[data-view="list"] .hs-card-media{width:270px;flex:none;aspect-ratio:auto}
  .higer-shop .hs-grid[data-view="list"] .hs-card-body{padding:20px}
  .higer-shop .hs-grid[data-view="list"] .hs-card-actions{max-width:340px}
}

/* حالت بدون نتیجه */
.higer-shop .hs-empty{padding:48px 24px;border:1px solid var(--hs-line);border-radius:24px;background:#fff;text-align:center;box-shadow:0 12px 30px rgba(16,36,62,.05)}
.higer-shop .hs-empty-ico{display:grid;place-items:center;width:60px;height:60px;margin:0 auto 14px;border-radius:20px;background:var(--hs-paper);color:var(--hs-gold-600)}
.higer-shop .hs-empty h3{font-size:18px;color:var(--hs-navy-900)}
.higer-shop .hs-empty p{max-width:440px;margin:8px auto 0;font-size:13px;line-height:2;color:var(--hs-navy-600)}
.higer-shop .hs-empty-actions{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin-top:20px}

/* ---------- نوار تماس پایین ---------- */
.higer-shop .hs-cta{padding-block:48px;background:radial-gradient(1100px 520px at 85% -10%,rgba(217,161,59,.16),transparent 60%),linear-gradient(160deg,#0b1a30 0%,#10243e 45%,#16304f 100%);color:var(--hs-cream)}
.higer-shop .hs-cta-inner{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:20px}
.higer-shop .hs-cta h2{margin-top:12px;font-size:22px;color:#fff}
@media(min-width:640px){.higer-shop .hs-cta h2{font-size:28px}}
.higer-shop .hs-cta p{display:flex;align-items:flex-start;gap:6px;margin-top:8px;font-size:12px;line-height:2;color:rgba(250,247,239,.74)}
.higer-shop .hs-cta p .hs-i{margin-top:5px;color:var(--hs-gold-400)}

/* ---------- نوار شناور مقایسه ---------- */
.higer-shop.has-cmp-dock .hs-cta{padding-bottom:124px}
.higer-shop .hs-cmp-dock{position:fixed;left:16px;bottom:14px;z-index:9985;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;width:fit-content;max-width:calc(100vw - 32px);padding:10px 14px;border:1px solid rgba(217,161,59,.48);border-radius:20px;background:rgba(16,36,62,.96);color:var(--hs-cream);box-shadow:0 20px 50px rgba(7,15,29,.5);backdrop-filter:blur(10px)}
.higer-shop .hs-cmp-dock-info{display:flex;align-items:center;gap:10px;min-width:0}
.higer-shop .hs-cmp-dock-ico{display:grid;flex:none;place-items:center;width:38px;height:38px;border-radius:12px;background:rgba(217,161,59,.18);color:var(--hs-gold-300)}
.higer-shop .hs-cmp-dock-info b{display:block;font-size:12px;font-weight:900;color:var(--hs-gold-300)}
.higer-shop .hs-cmp-dock-pills{display:flex;flex-wrap:wrap;gap:5px;margin-top:4px}
.higer-shop button.hs-dock-pill{display:inline-flex;align-items:center;gap:4px;padding:2px 8px;border-radius:9999px;background:rgba(255,255,255,.12);font-size:11px;font-weight:700;color:#fff}
.higer-shop button.hs-dock-pill:hover{background:rgba(185,28,28,.65)}
.higer-shop .hs-cmp-dock-actions{display:flex;align-items:center;gap:8px;margin-right:auto}
.higer-shop button.hs-cmp-clear{padding:8px 12px;border:1px solid rgba(255,255,255,.22);border-radius:9999px;font-size:11px;font-weight:800;color:rgba(250,247,239,.85)}
.higer-shop button.hs-cmp-clear:hover{border-color:#fca5a5;color:#fecaca}

/* ---------- مودال‌های مشاهده سریع سایزها و مقایسه ---------- */
.higer-shop .hs-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:14px}
.higer-shop .hs-modal-backdrop{position:absolute;inset:0;background:rgba(7,15,29,.68);backdrop-filter:blur(4px)}
.higer-shop .hs-modal-card{position:relative;z-index:1;display:flex;flex-direction:column;width:100%;max-height:calc(100vh - 28px);overflow:hidden;border:1px solid var(--hs-line);border-radius:26px;background:#fff;box-shadow:0 30px 80px rgba(7,15,29,.5)}
.higer-shop .hs-quick-card{max-width:680px;overflow-y:auto;padding:20px}
@media(min-width:640px){.higer-shop .hs-quick-card{padding:26px}}
.higer-shop .hs-cmp-card{max-width:1120px}
.higer-shop .hs-modal-head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;padding:18px 22px;border-bottom:1px solid var(--hs-line);background:var(--hs-cream)}
.higer-shop .hs-modal-head h3{margin-top:6px;font-size:18px;color:var(--hs-navy-900)}
.higer-shop .hs-cmp-modal-tools{display:flex;align-items:center;gap:10px}
.higer-shop .hs-cmp-size-pick{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:800;color:var(--hs-navy-700)}
.higer-shop .hs-cmp-size-pick select{height:38px;padding:0 12px;border:1.5px solid var(--hs-line);border-radius:9999px;background:#fff;font:inherit;font-size:12px;font-weight:800;color:var(--hs-navy-900)}
.higer-shop button.hs-modal-close{display:grid;flex:none;place-items:center;width:36px;height:36px;border:1px solid var(--hs-line);border-radius:50%;background:#fff;color:var(--hs-navy-900)}
.higer-shop button.hs-modal-close:hover{border-color:var(--hs-gold-500)}
.higer-shop .hs-modal-scroll{overflow:auto}

/* جدول مقایسه داخل مودال */
.higer-shop .hs-cmp-table{width:100%;border-collapse:collapse;font-size:13px}
.higer-shop .hs-cmp-table :is(th,td){padding:13px 16px;border-bottom:1px solid var(--hs-line);text-align:right;vertical-align:middle;white-space:nowrap}
.higer-shop .hs-cmp-table thead th{background:var(--hs-navy-900);color:var(--hs-gold-300);font-size:13px;font-weight:900}
.higer-shop .hs-cmp-table th[scope="row"]{position:sticky;right:0;z-index:1;background:var(--hs-cream);color:var(--hs-navy-700);font-weight:800;box-shadow:-1px 0 0 var(--hs-line)}
.higer-shop .hs-cmp-table thead th:first-child{position:sticky;right:0;z-index:2}
.higer-shop .hs-cmp-col-head{display:flex;align-items:center;justify-content:space-between;gap:10px}
.higer-shop .hs-cmp-col-head a{color:#fff;text-decoration:underline;text-underline-offset:3px}
.higer-shop button.hs-cmp-rm{display:grid;place-items:center;width:24px;height:24px;border-radius:50%;background:rgba(255,255,255,.14);color:#fff}
.higer-shop button.hs-cmp-rm:hover{background:var(--hs-bad)}

/* محتوای مودال مشاهده سریع سایزها */
.higer-shop .hs-qv-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px}
.higer-shop .hs-qv-top h3{font-size:22px;color:var(--hs-navy-900)}
.higer-shop .hs-qv-sub{margin-top:2px;font-size:13px;font-weight:700;color:var(--hs-navy-600)}
.higer-shop .hs-qv-price{margin-top:14px;padding:12px 16px;border:1px solid var(--hs-line);border-radius:16px;background:var(--hs-cream)}
.higer-shop .hs-qv-price small{display:block;font-size:11px;font-weight:800;color:var(--hs-navy-600)}
.higer-shop .hs-qv-price strong{font-size:20px;font-weight:900;color:var(--hs-navy-900)}
.higer-shop .hs-qv-sizes{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-top:14px}
@media(min-width:460px){.higer-shop .hs-qv-sizes{grid-template-columns:repeat(3,minmax(0,1fr))}}
.higer-shop button.hs-qv-size{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:10px 6px;border:1.5px solid var(--hs-line);border-radius:14px;background:#fffdf6;text-align:center;transition:border-color .2s,background .2s}
.higer-shop button.hs-qv-size:hover{border-color:var(--hs-gold-500)}
.higer-shop button.hs-qv-size[aria-pressed="true"]{border-color:var(--hs-gold-500);background:linear-gradient(160deg,#fffdf3,#fdf3d8);box-shadow:inset 0 0 0 1px rgba(217,161,59,.45)}
.higer-shop button.hs-qv-size:disabled{opacity:.42;cursor:not-allowed}
.higer-shop .hs-qv-size b{font-size:14px;font-weight:900}
.higer-shop .hs-qv-size small{min-height:15px;font-size:10px;font-weight:700;color:var(--hs-navy-600)}
.higer-shop .hs-qv-size span{font-size:11px;font-weight:800;color:var(--hs-gold-600)}
.higer-shop .hs-qv-foot{display:flex;flex-wrap:wrap;align-items:stretch;gap:10px;margin-top:18px;padding-top:16px;border-top:1px solid var(--hs-line)}
.higer-shop .hs-qty{display:flex;align-items:center;overflow:hidden;border:1.5px solid var(--hs-line);border-radius:9999px;background:#fff}
.higer-shop .hs-qty button{display:grid;place-items:center;width:36px;height:44px;color:var(--hs-navy-900)}
.higer-shop .hs-qty button:hover{background:var(--hs-paper)}
.higer-shop .hs-qty input{width:38px;height:44px;border:0;background:transparent;text-align:center;font:inherit;font-size:14px;font-weight:900;color:var(--hs-navy-900);-moz-appearance:textfield;appearance:textfield}
.higer-shop .hs-qty input::-webkit-inner-spin-button,.higer-shop .hs-qty input::-webkit-outer-spin-button{-webkit-appearance:none;margin:0}
.higer-shop .hs-qv-foot .hs-btn-gold{flex:1;min-width:170px}

@media(prefers-reduced-motion:reduce){.higer-shop *,.higer-shop *::before,.higer-shop *::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}}
</style>
<script id="higer-shop-js">
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
    if (root.getAttribute('data-hs-mounted')) return;
    var source = root.querySelector('script[data-hs-data]');
    var data;
    try { data = JSON.parse(source ? source.textContent : '{}'); } catch (e) { return; }
    root.setAttribute('data-hs-mounted', '1');

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
    all('[data-hs-card]').forEach(function (el) {
      cardNodes[Number(el.getAttribute('data-hs-card'))] = el;
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
      var rMin = one('[data-hs-price-min]');
      var rMax = one('[data-hs-price-max]');
      var outMin = one('[data-hs-price-min-out]');
      var outMax = one('[data-hs-price-max-out]');
      var fill = one('[data-hs-range-fill]');
      if (rMin) rMin.value = state.minPrice;
      if (rMax) rMax.value = state.maxPrice;
      if (outMin) outMin.textContent = faNum(state.minPrice);
      if (outMax) outMax.textContent = faNum(state.maxPrice);
      var priceReset = one('[data-hs-price-reset]');
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
      all('[data-hs-preset-min]').forEach(function (btn) {
        var pMin = Number(btn.getAttribute('data-hs-preset-min')) || 0;
        var pMax = Number(btn.getAttribute('data-hs-preset-max')) || 0;
        var effMin = pMin > 0 ? Math.max(boundMin, pMin) : boundMin;
        var effMax = pMax > 0 ? Math.min(boundMax, pMax) : boundMax;
        btn.classList.toggle('is-on', state.minPrice === effMin && state.maxPrice === effMax);
      });
    }

    function updateFacetCounts() {
      /* دسته‌ها */
      var baseCat = products.filter(function (p) { return matches(p, 'category'); });
      all('[data-hs-count="cat:"], [data-hs-cat-pill-count=""]').forEach(function (el) {
        el.textContent = toFa(baseCat.length);
      });
      if (baseCat) {
        all('[data-hs-count="cat:' + baseCat + '"], [data-hs-cat-pill-count="' + baseCat + '"]').forEach(function (el) {
          el.textContent = toFa(baseCat.length);
        });
      }
      categories.forEach(function (cat) {
        var n = baseCat.filter(function (p) { return (p.catSlugs || []).indexOf(cat.slug) > -1; }).length;
        all('[data-hs-count="cat:' + cat.slug + '"], [data-hs-cat-pill-count="' + cat.slug + '"]').forEach(function (el) {
          el.textContent = toFa(n);
        });
        all('.hs-cat-row[data-hs-cat="' + cat.slug + '"]').forEach(function (btn) {
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
        var cntEl = one('[data-hs-count="size:' + sz.slug + '"]');
        if (cntEl) cntEl.textContent = '(' + toFa(n) + ')';
        all('[data-hs-size="' + sz.slug + '"]').forEach(function (btn) {
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
          var el = one('[data-hs-count="' + g.key + ':' + item.slug + '"]');
          if (el) el.textContent = toFa(n);
          all('[data-hs-facet="' + g.key + '"][data-value="' + item.slug + '"]').forEach(function (btn) {
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
          var el = one('[data-hs-count="' + gk + ':' + item.slug + '"]');
          if (el) el.textContent = toFa(n);
          all('[data-hs-facet="' + gk + '"][data-value="' + item.slug + '"]').forEach(function (btn) {
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
          var el = one('[data-hs-count="extra:' + ex.tax + ':' + item.slug + '"]');
          if (el) el.textContent = toFa(n);
          all('[data-hs-extra="' + ex.tax + '"][data-value="' + item.slug + '"]').forEach(function (btn) {
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
      var qInput = one('[data-hs-search]');
      if (qInput && qInput.value !== state.search) qInput.value = state.search;
      var qClear = one('[data-hs-search-clear]');
      if (qClear) qClear.hidden = !state.search;

      var showOutChk = one('[data-hs-showout]');
      if (showOutChk) showOutChk.checked = !state.hideOut;
      var onSaleChk = one('[data-hs-onsale]');
      if (onSaleChk) onSaleChk.checked = state.onSale;

      all('[data-hs-cat]').forEach(function (btn) {
        btn.setAttribute('aria-pressed', btn.getAttribute('data-hs-cat') === state.category ? 'true' : 'false');
      });
      all('[data-hs-size]').forEach(function (btn) {
        btn.setAttribute('aria-pressed', btn.getAttribute('data-hs-size') === state.size ? 'true' : 'false');
      });
      ['firmness', 'layer', 'warranty', 'spring', 'special', 'fabric'].forEach(function (fk) {
        all('[data-hs-facet="' + fk + '"]').forEach(function (btn) {
          var on = state[fk].indexOf(btn.getAttribute('data-value')) > -1;
          btn.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
      });
      all('[data-hs-extra]').forEach(function (btn) {
        var tx = btn.getAttribute('data-hs-extra');
        var list = state.extra[tx] || [];
        btn.setAttribute('aria-pressed', list.indexOf(btn.getAttribute('data-value')) > -1 ? 'true' : 'false');
      });
      all('[data-hs-sort]').forEach(function (sel) {
        if (sel.value !== state.sort) sel.value = state.sort;
      });
      all('[data-hs-view]').forEach(function (btn) {
        btn.setAttribute('aria-pressed', btn.getAttribute('data-hs-view') === state.view ? 'true' : 'false');
      });
      var grid = one('[data-hs-grid]');
      if (grid) grid.setAttribute('data-view', state.view);

      /* هماهنگی زنده سربرگ با دسته‌بندی انتخاب‌شده */
      var hDef = data.heroDefault || null;
      var hCores = data.heroCores || {};
      var hTitle = one('[data-hs-hero-title]');
      var hSub = one('[data-hs-hero-sub]');
      var hKick = one('[data-hs-hero-kicker]');
      var hArt = one('[data-hs-hero-art]');
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
        var pLabel = one('[data-hs-card-plabel="' + p.id + '"]');
        var pVal = one('[data-hs-card-price="' + p.id + '"]');
        var pReg = one('[data-hs-card-reg="' + p.id + '"]');
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
        Array.prototype.forEach.call(card.querySelectorAll('[data-hs-link="' + p.id + '"]'), function (lnk) {
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
      all('[data-hs-shown-count], [data-hs-result-num]').forEach(function (el) { el.textContent = countFa; });
      if (baseCat) {
        var heroBadge = one('[data-hs-total-badge]');
        if (heroBadge) heroBadge.textContent = countFa + ' مدل';
      }
      var empty = one('[data-hs-empty]');
      if (empty) empty.hidden = matched.length > 0;
      if (grid) grid.hidden = matched.length === 0;

      var sizeBanner = one('[data-hs-size-banner]');
      if (sizeBanner) {
        sizeBanner.hidden = !state.size;
        sizeBanner.textContent = state.size ? 'قیمت‌ها برای سایز ' + sizeLabel : '';
      }

      /* چیپ‌های فیلتر فعال */
      var chips = buildActiveChips();
      all('[data-hs-active-count]').forEach(function (b) {
        b.textContent = toFa(chips.length);
        b.hidden = chips.length === 0;
      });
      all('.hs-reset-link').forEach(function (btn) {
        btn.hidden = chips.length === 0;
        btn.classList.toggle('is-visible', chips.length > 0);
      });
      all('[data-hs-active-chips]').forEach(function (chipsWrap) {
        chipsWrap.innerHTML = chips.map(function (c, i) {
          return '<button type="button" class="hs-chip" data-hs-rm-chip="' + i + '">' + esc(c.label) + ' <span aria-hidden="true">×</span></button>';
        }).join('');
        chipsWrap._chips = chips;
      });
      var activeBar = one('[data-hs-active-bar]');
      if (activeBar) activeBar.hidden = chips.length === 0;
      var sidebarBar = one('.hs-sidebar-head');
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
    var sidebar = one('[data-hs-sidebar]');
    var backdrop = one('.hs-backdrop');
    var drawerBtn = one('[data-hs-drawer-open]');
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
      all('[data-hs-cmp]').forEach(function (btn) {
        var id = Number(btn.getAttribute('data-hs-cmp'));
        btn.setAttribute('aria-pressed', basket.indexOf(id) > -1 ? 'true' : 'false');
      });
      var dock = one('[data-hs-cmp-dock]');
      var dockCnt = one('[data-hs-cmp-count]');
      var pills = one('[data-hs-cmp-pills]');
      if (dock) dock.hidden = basket.length === 0;
      root.classList.toggle('has-cmp-dock', basket.length > 0);
      if (dockCnt) dockCnt.textContent = '(' + toFa(basket.length) + ')';
      if (pills) {
        pills.innerHTML = basket.map(function (id) {
          var p = cmpById[id];
          return p ? '<button type="button" class="hs-dock-pill" data-hs-cmp-rm="' + id + '" title="حذف از مقایسه">' + esc(p.name) + ' ×</button>' : '';
        }).join('');
      }
      var cmpModal = one('[data-hs-cmp-modal]');
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
      var wrap = one('[data-hs-cmp-table-wrap]');
      if (!wrap) return;
      var items = basket.map(function (id) { return cmpById[id]; }).filter(Boolean);
      if (!items.length) {
        wrap.innerHTML = '<p style="padding:28px;text-align:center;font-weight:700">هیچ مدلی در فهرست مقایسه نیست.</p>';
        return;
      }
      var activeSz = cmpSize || state.size || '';
      var cmpSel = one('[data-hs-cmp-size]');
      if (cmpSel && cmpSel.value !== activeSz) cmpSel.value = activeSz;
      var szTitle = activeSz ? 'قیمت سایز ' + labelForFacet('sizes', activeSz) : 'محدوده قیمت';

      var headCols = items.map(function (p) {
        return '<th scope="col"><div class="hs-cmp-col-head"><a href="' + esc(p.url) + '">' + esc(p.name) + '</a><button type="button" class="hs-cmp-rm" data-hs-cmp-rm="' + p.id + '" aria-label="حذف">×</button></div></th>';
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
            m = ' <span class="hs-mini-meter">';
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

      wrap.innerHTML = '<table class="hs-cmp-table"><thead><tr><th scope="col">ویژگی</th>' + headCols + '</tr></thead><tbody>' + bodyHtml + '</tbody></table>';
    }

    /* ---------- مودال مشاهده سریع سایزها و خرید مستقیم ---------- */
    var quickModal = one('[data-hs-quick-modal]');
    var quickBody = one('[data-hs-quick-body]');
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
        return '<button type="button" class="hs-qv-size" data-hs-qv-size="' + esc(sk) + '" aria-pressed="' + (on ? 'true' : 'false') + '"' + (s.inStock ? '' : ' disabled') + '>' +
          '<b>' + esc(s.label) + '</b>' +
          '<small>' + esc(s.sub || '') + '</small>' +
          '<span>' + esc(s.inStock ? (s.price ? faNum(s.price) : '') : 'ناموجود') + '</span>' +
          '</button>';
      }).join('');

      var pageHref = p.url + (activeQuickSize && p.sizeKey ? (p.url.indexOf('?') > -1 ? '&' : '?') + 'attribute_' + encodeURIComponent(p.sizeKey) + '=' + encodeURIComponent(activeQuickSize) : '');

      quickBody.innerHTML =
        '<div class="hs-qv-top">' +
          '<div>' +
            '<span class="hs-kicker">' + esc(p.primaryCat ? p.primaryCat.name : 'مشاهده سریع') + '</span>' +
            '<h3>' + esc(p.name) + '</h3>' +
            (p.short ? '<p class="hs-qv-sub">' + esc(p.short) + '</p>' : '') +
          '</div>' +
          '<button type="button" class="hs-modal-close" data-hs-modal-close aria-label="بستن">×</button>' +
        '</div>' +
        '<div class="hs-qv-price"><small>' + esc(pTitle) + '</small><strong>' + esc(priceStr) + '</strong></div>' +
        '<div class="hs-qv-sizes" role="group" aria-label="انتخاب سایز">' + sizeBtns + '</div>' +
        '<form class="hs-qv-foot cart" method="post" enctype="multipart/form-data" action="' + esc(p.url) + '">' +
          '<input type="hidden" name="add-to-cart" value="' + p.id + '">' +
          '<input type="hidden" name="product_id" value="' + p.id + '">' +
          '<input type="hidden" name="variation_id" value="' + (szObj ? szObj.vid : '') + '">' +
          '<input type="hidden" name="attribute_' + esc(p.sizeKey || 'pa_size') + '" value="' + esc(activeQuickSize) + '">' +
          '<div class="hs-qty">' +
            '<button type="button" data-hs-qv-qty="1" aria-label="افزایش">+</button>' +
            '<input type="number" name="quantity" value="' + (p.minQty || 1) + '" min="' + (p.minQty || 1) + '" step="1" aria-label="تعداد" data-hs-qv-qty-input>' +
            '<button type="button" data-hs-qv-qty="-1" aria-label="کاهش">−</button>' +
          '</div>' +
          '<button type="submit" class="hs-btn-gold"' + (canBuy ? '' : ' disabled') + '>افزودن به سبد خرید</button>' +
          '<a class="hs-btn-sec" href="' + esc(pageHref) + '">صفحه کامل محصول</a>' +
        '</form>';
    }

    function closeModals() {
      if (quickModal) quickModal.hidden = true;
      var cmpModal = one('[data-hs-cmp-modal]');
      if (cmpModal) cmpModal.hidden = true;
      if (!sidebar || !sidebar.classList.contains('is-open')) {
        document.documentElement.style.overflow = '';
      }
    }

    /* ---------- رویدادهای کلیک و تغییر ---------- */
    root.addEventListener('click', function (event) {
      var target = event.target.closest ? event.target.closest('button, a, [data-hs-drawer-close], [data-hs-modal-close]') : null;
      if (!target || !root.contains(target)) return;

      if (target.hasAttribute('data-hs-drawer-open')) { setDrawer(true); return; }
      if (target.hasAttribute('data-hs-drawer-close')) { setDrawer(false); return; }
      if (target.hasAttribute('data-hs-modal-close')) { closeModals(); return; }

      if (target.hasAttribute('data-hs-cat')) {
        var nextCat = target.getAttribute('data-hs-cat') || '';
        if (baseCat) {
          state.category = (nextCat === '' || state.category === nextCat) ? baseCat : nextCat;
        } else {
          state.category = (state.category === nextCat && nextCat !== '') ? '' : nextCat;
        }
        render();
        return;
      }
      if (target.hasAttribute('data-hs-size')) {
        var nextSz = target.getAttribute('data-hs-size') || '';
        state.size = state.size === nextSz ? '' : nextSz;
        render();
        return;
      }
      if (target.hasAttribute('data-hs-facet')) {
        var fk = target.getAttribute('data-hs-facet');
        var fv = target.getAttribute('data-value');
        if (state[fk]) { toggleInArray(state[fk], fv); render(); }
        return;
      }
      if (target.hasAttribute('data-hs-extra')) {
        var tx = target.getAttribute('data-hs-extra');
        var tv = target.getAttribute('data-value');
        if (!state.extra[tx]) state.extra[tx] = [];
        toggleInArray(state.extra[tx], tv);
        render();
        return;
      }
      if (target.hasAttribute('data-hs-preset-min')) {
        var pMin = Number(target.getAttribute('data-hs-preset-min')) || 0;
        var pMax = Number(target.getAttribute('data-hs-preset-max')) || 0;
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
      if (target.hasAttribute('data-hs-search-clear')) {
        state.search = '';
        render();
        var si = one('[data-hs-search]');
        if (si) si.focus();
        return;
      }
      if (target.hasAttribute('data-hs-price-reset')) {
        state.minPrice = boundMin;
        state.maxPrice = boundMax;
        render();
        return;
      }
      if (target.hasAttribute('data-hs-reset')) { resetAll(); return; }
      if (target.hasAttribute('data-hs-rm-chip')) {
        var chipsWrap = one('[data-hs-active-chips]');
        var cList = chipsWrap && chipsWrap._chips ? chipsWrap._chips : [];
        var chip = cList[Number(target.getAttribute('data-hs-rm-chip'))];
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
      if (target.hasAttribute('data-hs-guide-toggle')) {
        var gBody = one('[data-hs-guide-body]');
        if (gBody) {
          var willOpen = gBody.classList.contains('is-clamped');
          gBody.classList.toggle('is-clamped', !willOpen);
          target.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
          var gl = target.querySelector('span');
          if (gl) gl.textContent = willOpen ? 'بستن توضیحات' : 'مطالعه کامل راهنمای دسته';
        }
        return;
      }
      if (target.hasAttribute('data-hs-view')) {
        state.view = target.getAttribute('data-hs-view') || 'grid';
        render();
        return;
      }
      if (target.hasAttribute('data-hs-cmp')) {
        toggleCompare(Number(target.getAttribute('data-hs-cmp')));
        return;
      }
      if (target.hasAttribute('data-hs-cmp-rm')) {
        toggleCompare(Number(target.getAttribute('data-hs-cmp-rm')));
        return;
      }
      if (target.hasAttribute('data-hs-cmp-clear')) {
        basket = [];
        writeBasket(basket);
        renderCompareUI();
        closeModals();
        return;
      }
      if (target.hasAttribute('data-hs-cmp-open')) {
        var cmpModal = one('[data-hs-cmp-modal]');
        if (cmpModal) {
          cmpSize = state.size || '';
          renderCompareTable();
          cmpModal.hidden = false;
          document.documentElement.style.overflow = 'hidden';
        }
        return;
      }
      if (target.hasAttribute('data-hs-quick')) {
        openQuickModal(Number(target.getAttribute('data-hs-quick')));
        return;
      }
      if (target.hasAttribute('data-hs-qv-size')) {
        activeQuickSize = target.getAttribute('data-hs-qv-size');
        renderQuickModal();
        return;
      }
      if (target.hasAttribute('data-hs-qv-qty') && quickBody) {
        var qIn = quickBody.querySelector('[data-hs-qv-qty-input]');
        if (qIn) {
          var nextQ = Math.max(Number(qIn.min) || 1, (Number(qIn.value) || 1) + Number(target.getAttribute('data-hs-qv-qty')));
          qIn.value = nextQ;
        }
      }
    });

    /* جستجو، اسلایدر قیمت و مرتب‌سازی */
    var searchEl = one('[data-hs-search]');
    if (searchEl) {
      searchEl.addEventListener('input', function () {
        state.search = searchEl.value;
        render();
      });
    }
    var showOutEl = one('[data-hs-showout]');
    if (showOutEl) {
      showOutEl.addEventListener('change', function () { state.hideOut = !showOutEl.checked; render(); });
    }
    var onSaleEl = one('[data-hs-onsale]');
    if (onSaleEl) {
      onSaleEl.addEventListener('change', function () { state.onSale = onSaleEl.checked; render(); });
    }
    var rMinEl = one('[data-hs-price-min]');
    var rMaxEl = one('[data-hs-price-max]');
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
    var priceResetBtn = one('[data-hs-price-reset]');
    if (priceResetBtn) {
      priceResetBtn.addEventListener('click', function () {
        state.minPrice = boundMin;
        state.maxPrice = boundMax;
        render();
      });
    }
    all('[data-hs-sort]').forEach(function (sel) {
      sel.addEventListener('change', function () { state.sort = sel.value; render(); });
    });
    var cmpSizeSel = one('[data-hs-cmp-size]');
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
        root.style.setProperty('--hs-sticky-top', px + 'px');
      }
      var dpx = Math.max(px, Math.floor(drawerTop));
      if (dpx !== lastDrawerTop) {
        lastDrawerTop = dpx;
        root.style.setProperty('--hs-drawer-top', dpx + 'px');
      }
      var mbar = root.querySelector('.hs-mobile-bar');
      var mh = mbar && mbar.offsetParent !== null ? Math.ceil(mbar.getBoundingClientRect().height) : 0;
      if (mh !== lastMbarH) {
        lastMbarH = mh;
        root.style.setProperty('--hs-mbar-h', mh + 'px');
      }
    }
    syncStickyOffset();
    window.addEventListener('scroll', syncStickyOffset, { passive: true });
    window.addEventListener('resize', syncStickyOffset);
    window.addEventListener('load', syncStickyOffset);

    /* حالت تمام‌عرض حتی داخل ستون محدود المنتور */
    if (root.getAttribute('data-hs-fw') === 'yes') {
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
    Array.prototype.forEach.call(document.querySelectorAll('.higer-shop'), mount);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
</script>
<?php
		return (string) ob_get_clean();
	}
}

if ( ! function_exists( 'higer_shop_context' ) ) {
	/** زمینه فعلی صفحه (فروشگاه کل، آرشیو دسته‌بندی، آرشیو ویژگی یا جستجو) را تشخیص می‌دهد. */
	function higer_shop_context( $atts, $cfg ) {
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
						$ctx['crumbs'][] = array( 'name' => $anc->name, 'url' => higer_shop_term_url( $anc, 'product_cat' ) );
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

if ( ! function_exists( 'higer_shop_render' ) ) {
	function higer_shop_render( $atts = array() ) {
		static $instance = 0;
		if ( ! function_exists( 'wc_get_products' ) ) {
			return '';
		}
		$instance++;
		$atts    = shortcode_atts( array( 'category' => '', 'fullwidth' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_shop' );
		$cfg     = higer_shop_config();
		$catalog = higer_shop_catalog( $cfg );
		$ctx     = higer_shop_context( $atts, $cfg );
		$store   = $cfg['store'];
		$fa      = 'higer_shop_fa';
		$uid     = 'hs-' . $instance;

		$is_cat_page  = ! empty( $ctx['is_category'] ) && '' !== $ctx['category'];
		$scoped       = $is_cat_page ? higer_shop_scope_catalog( $catalog, $ctx['category'], $cfg ) : null;
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
		$scale_max    = higer_shop_firmness_max( $cfg['attributes']['firmness'] );

		/* پیام‌های سبد خرید ووکامرس */
		$wc      = function_exists( 'WC' ) ? WC() : null;
		$notices = ( $wc && ! empty( $wc->session ) && function_exists( 'wc_print_notices' ) ) ? (string) wc_print_notices( true ) : '';

		/* داده ارسالی به جاوااسکریپت برای فیلتر، مرتب‌سازی، قیمت سایز و مقایسه */
		$hero_cores = array();
		foreach ( $cfg['cores'] as $cslug => $cinfo ) {
			$hero_cores[ $cslug ] = array(
				'title' => $cinfo['title'],
				'text'  => $cinfo['text'],
				'svg'   => higer_shop_core_svg( $cinfo['key'] ),
			);
		}
		$payload = array(
			'stickyOffset' => isset( $cfg['sticky_offset'] ) ? max( 0, (int) $cfg['sticky_offset'] ) : 0,
			'heroDefault'  => array(
				'kicker'   => $cfg['hero']['kicker'],
				'title'    => $cfg['hero']['title'],
				'subtitle' => $cfg['hero']['subtitle'],
				'svg'      => higer_shop_core_svg( 'bonnell' ),
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
		echo higer_shop_assets(); // phpcs:ignore
		?>
<div class="higer-shop" id="<?php echo esc_attr( $uid ); ?>" dir="rtl" lang="fa" data-hs-fw="<?php echo 'no' === strtolower( (string) $atts['fullwidth'] ) ? 'no' : 'yes'; ?>">
	<script type="application/json" data-hs-data><?php echo wp_json_encode( $payload, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?></script>
	<?php if ( '' !== trim( $notices ) ) : ?><div class="hs-wrap hs-notices"><?php echo $notices; // phpcs:ignore ?></div><?php endif; ?>

	<!-- ===== سربرگ صفحه (اختصاصی دسته‌بندی یا اصلی فروشگاه) ===== -->
	<?php
	$hero_cls = 'hs-hero';
	if ( $is_cat_page ) {
		$hero_cls .= ' is-category is-theme-' . sanitize_html_class( $ctx['theme'] );
	}
	?>
	<header class="<?php echo esc_attr( $hero_cls ); ?>"<?php echo $is_cat_page ? ' data-hs-cat-hero="' . esc_attr( $ctx['category'] ) . '"' : ''; ?>>
		<nav class="hs-crumbs" aria-label="مسیر صفحه">
			<div class="hs-wrap hs-crumbs-row">
				<ol>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a></li>
					<?php foreach ( $ctx['crumbs'] as $crumb ) : ?>
					<li<?php echo '' === $crumb['url'] ? ' aria-current="page"' : ''; ?>><?php if ( '' !== $crumb['url'] ) : ?><a href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['name'] ); ?></a><?php else : echo esc_html( $crumb['name'] ); endif; ?></li>
					<?php endforeach; ?>
				</ol>
				<?php if ( $is_cat_page && '' !== $ctx['shop_url'] ) : ?>
				<a class="hs-back-shop" href="<?php echo esc_url( $ctx['shop_url'] ); ?>">همه محصولات فروشگاه <?php echo higer_shop_icon( 'chevron-left', 13 ); // phpcs:ignore ?></a>
				<?php endif; ?>
			</div>
		</nav>

		<?php if ( $is_cat_page ) : ?>
		<div class="hs-wrap hs-hero-grid">
			<div class="hs-hero-copy">
				<span class="hs-kicker is-dark"><?php echo higer_shop_icon( 'layers', 13 ); // phpcs:ignore ?> <span data-hs-hero-kicker><?php echo esc_html( $ctx['kicker'] ); ?></span> • <b data-hs-total-badge><?php echo esc_html( $vis_fa ); ?> مدل</b></span>
				<h1 class="hs-hero-title" data-hs-hero-title><?php
					echo esc_html( $ctx['title'] );
					if ( '' !== $ctx['title_accent'] ) {
						echo ' <span class="hs-gold-text">' . esc_html( $ctx['title_accent'] ) . '</span>';
					}
					if ( '' !== $ctx['title_after'] ) {
						echo ' ' . esc_html( $ctx['title_after'] );
					}
				?></h1>
				<p class="hs-hero-sub" data-hs-hero-sub><?php echo esc_html( $ctx['subtitle'] ); ?></p>

				<?php if ( ! empty( $ctx['highlights'] ) ) : ?>
				<ul class="hs-cat-traits" aria-label="ویژگی‌های این دسته‌بندی">
					<?php foreach ( $ctx['highlights'] as $hl ) : ?>
					<li><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $hl ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( ! empty( $cat_stats ) ) : ?>
				<div class="hs-cat-stats" aria-label="خلاصه این دسته‌بندی">
					<?php foreach ( $cat_stats as $st ) : ?>
					<div class="hs-cat-stat">
						<small><?php echo esc_html( $st['label'] ); ?></small>
						<b<?php echo '' !== $st['attr'] ? ' ' . $st['attr'] : ''; // phpcs:ignore ?>><?php echo esc_html( $st['value'] ); ?></b>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<div class="hs-hero-art is-cat" data-hs-hero-art>
				<div class="hs-cat-art-stage<?php echo '' !== $ctx['thumb_url'] ? ' has-img' : ''; ?>">
					<?php if ( '' !== $ctx['thumb_url'] ) : ?>
					<img src="<?php echo esc_url( $ctx['thumb_url'] ); ?>" alt="<?php echo esc_attr( $ctx['cat_name'] ); ?>" decoding="async">
					<?php else : ?>
					<?php echo higer_shop_core_svg( $ctx['core_key'] ); // phpcs:ignore ?>
					<?php endif; ?>
				</div>
				<?php if ( '' !== $ctx['art_label'] ) : ?>
				<div class="hs-cat-art-cap">
					<span><?php echo esc_html( $ctx['art_label'] ); ?></span>
					<?php echo higer_shop_icon( 'bed', 15 ); // phpcs:ignore ?>
				</div>
				<?php endif; ?>
				<?php if ( $show_finder ) : ?>
				<a class="hs-cat-finder-mini" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
					<span><?php echo higer_shop_icon( 'sparkles', 14 ); // phpcs:ignore ?> تشک‌سنج هوشمند هیگر</span>
					<?php echo higer_shop_icon( 'chevron-left', 14 ); // phpcs:ignore ?>
				</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( ! empty( $categories ) ) : ?>
		<div class="hs-wrap">
			<div class="hs-cat-nav-row" role="tablist" aria-label="زیرمجموعه‌های <?php echo esc_attr( $ctx['cat_name'] ); ?>">
				<span class="hs-cat-strip-label">زیرمجموعه‌ها:</span>
				<button type="button" class="hs-cat-pill" data-hs-cat="<?php echo esc_attr( $ctx['category'] ); ?>" aria-pressed="true">
					<b>همه <?php echo esc_html( $ctx['cat_name'] ); ?></b>
					<span data-hs-cat-pill-count="<?php echo esc_attr( $ctx['category'] ); ?>"><?php echo esc_html( $vis_fa ); ?></span>
				</button>
				<?php foreach ( $categories as $sub ) : ?>
				<button type="button" class="hs-cat-pill<?php echo $sub['depth'] > 0 ? ' is-sub' : ''; ?>" data-hs-cat="<?php echo esc_attr( $sub['slug'] ); ?>" aria-pressed="false">
					<b><?php echo esc_html( $sub['name'] ); ?></b>
					<span data-hs-cat-pill-count="<?php echo esc_attr( $sub['slug'] ); ?>"><?php echo esc_html( $fa( $sub['count'] ) ); ?></span>
				</button>
				<?php endforeach; ?>
			</div>
		</div>
		<?php elseif ( count( $siblings ) > 1 || $parent_cat ) : ?>
		<nav class="hs-wrap" aria-label="سایر دسته‌بندی‌های مرتبط">
			<div class="hs-cat-nav-row">
				<span class="hs-cat-strip-label"><?php echo $parent_cat ? esc_html( 'دسته‌های ' . $parent_cat['name'] . ':' ) : 'سایر دسته‌ها:'; ?></span>
				<?php if ( $parent_cat && '' !== $parent_cat['url'] ) : ?>
				<a class="hs-cat-pill is-ghost" href="<?php echo esc_url( $parent_cat['url'] ); ?>"><b>همه <?php echo esc_html( $parent_cat['name'] ); ?></b><span><?php echo esc_html( $fa( $cat_cnt( $parent_cat ) ) ); ?></span></a>
				<?php endif; ?>
				<?php foreach ( $siblings as $sib ) :
					$is_cur = $sib['slug'] === $ctx['category'];
					?>
				<a class="hs-cat-pill<?php echo $is_cur ? ' is-active' : ''; ?>" href="<?php echo esc_url( $sib['url'] ); ?>"<?php echo $is_cur ? ' aria-current="page"' : ''; ?>>
					<b><?php echo esc_html( $sib['name'] ); ?></b>
					<span><?php echo esc_html( $is_cur ? $vis_fa : $fa( $cat_cnt( $sib ) ) ); ?></span>
				</a>
				<?php endforeach; ?>
				<?php if ( '' !== $ctx['shop_url'] ) : ?>
				<a class="hs-cat-pill is-ghost" href="<?php echo esc_url( $ctx['shop_url'] ); ?>"><b>کل فروشگاه</b><span><?php echo esc_html( $all_shop_fa ); ?></span></a>
				<?php endif; ?>
			</div>
		</nav>
		<?php endif; ?>

		<?php else : ?>
		<div class="hs-wrap hs-hero-grid">
			<div class="hs-hero-copy">
				<span class="hs-kicker is-dark"><?php echo higer_shop_icon( 'layers', 13 ); // phpcs:ignore ?> <span data-hs-hero-kicker><?php echo esc_html( $ctx['kicker'] ); ?></span> • <b data-hs-total-badge><?php echo esc_html( $total_fa ); ?> محصول</b></span>
				<h1 class="hs-hero-title" data-hs-hero-title><?php echo esc_html( $ctx['title'] ); ?></h1>
				<p class="hs-hero-sub" data-hs-hero-sub><?php echo esc_html( $ctx['subtitle'] ); ?></p>
			<?php if ( $show_finder ) : ?>
			<a class="hs-hero-finder" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
				<span class="hs-finder-ico" aria-hidden="true"><?php echo higer_shop_icon( 'sparkles', 20 ); // phpcs:ignore ?></span>
				<span class="hs-finder-copy">
					<b>تشک‌سنج هوشمند هیگر</b>
					<small>نمی‌دانید کدام مدل مناسب شماست؟ با چند سؤال بررسی کنید</small>
				</span>
				<span class="hs-finder-go">شروع <?php echo higer_shop_icon( 'chevron-left', 14 ); // phpcs:ignore ?></span>
			</a>
			<?php endif; ?>
			</div>
			<div class="hs-hero-art" aria-hidden="true" data-hs-hero-art>
				<?php echo higer_shop_core_svg( $ctx['core_key'] ); // phpcs:ignore ?>
			</div>
		</div>
		<?php if ( $categories ) : ?>
		<div class="hs-wrap hs-cat-strip-wrap">
			<div class="hs-cat-strip" role="tablist" aria-label="دسته‌بندی سریع محصولات">
				<button type="button" class="hs-cat-pill" data-hs-cat="" aria-pressed="<?php echo '' === $ctx['category'] ? 'true' : 'false'; ?>">
					<b>همه محصولات</b>
					<span data-hs-cat-pill-count=""><?php echo esc_html( $total_fa ); ?></span>
				</button>
				<?php foreach ( $categories as $cat ) : ?>
				<button type="button" class="hs-cat-pill<?php echo $cat['depth'] > 0 ? ' is-sub' : ''; ?>" data-hs-cat="<?php echo esc_attr( $cat['slug'] ); ?>" aria-pressed="<?php echo $cat['slug'] === $ctx['category'] ? 'true' : 'false'; ?>">
					<b><?php echo esc_html( $cat['name'] ); ?></b>
					<span data-hs-cat-pill-count="<?php echo esc_attr( $cat['slug'] ); ?>"><?php echo esc_html( $fa( $cat['count'] ) ); ?></span>
				</button>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	</header>

	<!-- ===== نوار ابزار چسبنده موبایل ===== -->
	<div class="hs-mobile-bar" data-hs-mobile-bar>
		<div class="hs-wrap hs-mobile-bar-inner">
			<button type="button" class="hs-mobile-filter-btn" data-hs-drawer-open aria-expanded="false" aria-controls="<?php echo esc_attr( $uid ); ?>-sidebar">
				<?php echo higer_shop_icon( 'sliders', 16 ); // phpcs:ignore ?>
				<span>فیلترها</span>
				<b class="hs-badge" data-hs-active-count hidden>۰</b>
			</button>
			<label class="hs-mobile-sort">
				<span class="hs-sr">مرتب‌سازی</span>
				<select data-hs-sort>
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
	<section class="hs-main">
		<div class="hs-wrap hs-layout">

			<!-- پس‌زمینه تیره دراور موبایل -->
			<div class="hs-backdrop" data-hs-drawer-close hidden></div>

			<!-- ===== سایدبار تمام فیلترها ===== -->
			<aside class="hs-sidebar" id="<?php echo esc_attr( $uid ); ?>-sidebar" data-hs-sidebar aria-label="فیلترهای محصولات">
				<div class="hs-sidebar-head">
					<div class="hs-sidebar-title">
						<?php echo higer_shop_icon( 'sliders', 17 ); // phpcs:ignore ?>
						<h2>فیلتر محصولات</h2>
						<span class="hs-badge" data-hs-active-count hidden>۰</span>
						<button type="button" class="hs-drawer-close" data-hs-drawer-close aria-label="بستن فیلترها"><?php echo higer_shop_icon( 'close', 18 ); // phpcs:ignore ?></button>
					</div>
					<div class="hs-active-chips" data-hs-active-chips></div>
					<button type="button" class="hs-reset-link" data-hs-reset hidden><?php echo higer_shop_icon( 'reset', 13 ); // phpcs:ignore ?> پاک کردن همه فیلترها</button>
				</div>

				<div class="hs-sidebar-body">
					<!-- ۱. جستجوی آنی -->
					<div class="hs-fgroup hs-fgroup-plain">
						<label class="hs-search" for="<?php echo esc_attr( $uid ); ?>-q">
							<?php echo higer_shop_icon( 'search', 16 ); // phpcs:ignore ?>
							<input id="<?php echo esc_attr( $uid ); ?>-q" type="search" placeholder="جستجو: هلسا، رکسانا، مموری فوم..." value="<?php echo esc_attr( $ctx['search'] ); ?>" autocomplete="off" data-hs-search>
							<button type="button" class="hs-search-clear" data-hs-search-clear aria-label="پاک کردن جستجو"<?php echo '' === $ctx['search'] ? ' hidden' : ''; ?>><?php echo higer_shop_icon( 'close', 14 ); // phpcs:ignore ?></button>
						</label>
						<div class="hs-toggles">
							<?php if ( ! empty( $cfg['show_out_of_stock'] ) ) : ?>
							<label class="hs-switch">
								<input type="checkbox" data-hs-showout<?php echo empty( $cfg['hide_out_of_stock'] ) ? ' checked' : ''; ?>>
								<span class="hs-switch-ui" aria-hidden="true"></span>
								<span>نمایش کالاهای ناموجود</span>
							</label>
							<?php endif; ?>
							<?php if ( $has_sale ) : ?>
							<label class="hs-switch">
								<input type="checkbox" data-hs-onsale>
								<span class="hs-switch-ui" aria-hidden="true"></span>
								<span>فقط تخفیف‌دارها</span>
							</label>
							<?php endif; ?>
						</div>
					</div>

					<!-- ۲. انتخاب سایز تخت (نمایش قیمت دقیق همان سایز) -->
					<?php if ( ! empty( $facets['sizes'] ) ) : ?>
					<details class="hs-fgroup" open>
						<summary><span><?php echo higer_shop_icon( 'ruler', 15 ); // phpcs:ignore ?> سایز تخت <small class="hs-fhint">(نمایش قیمت سایز)</small></span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody">
							<div class="hs-size-grid">
								<?php foreach ( $facets['sizes'] as $sz ) : ?>
								<button type="button" class="hs-size-chip" data-hs-size="<?php echo esc_attr( $sz['slug'] ); ?>" aria-pressed="<?php echo $sz['slug'] === $ctx['size'] ? 'true' : 'false'; ?>">
									<b><?php echo esc_html( $sz['label'] ); ?></b>
									<?php if ( '' !== $sz['sub'] ) : ?><small><?php echo esc_html( $sz['sub'] ); ?></small><?php endif; ?>
									<em data-hs-count="size:<?php echo esc_attr( $sz['slug'] ); ?>"></em>
								</button>
								<?php endforeach; ?>
							</div>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۳. محدوده قیمت -->
					<?php if ( $max_price > 0 && $max_price > $min_price ) : ?>
					<details class="hs-fgroup" open>
						<summary><span>محدوده قیمت (تومان)</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody">
							<div class="hs-price-readout">
								<span>از <b data-hs-price-min-out><?php echo esc_html( higer_shop_number( $min_price ) ); ?></b></span>
								<span>تا <b data-hs-price-max-out><?php echo esc_html( higer_shop_number( $max_price ) ); ?></b></span>
							</div>
							<div class="hs-range-dual" data-hs-range-wrap>
								<div class="hs-range-track"><span data-hs-range-fill></span></div>
								<input type="range" min="<?php echo esc_attr( (string) (int) $min_price ); ?>" max="<?php echo esc_attr( (string) (int) $max_price ); ?>" step="500000" value="<?php echo esc_attr( (string) (int) $min_price ); ?>" aria-label="حداقل قیمت" data-hs-price-min>
								<input type="range" min="<?php echo esc_attr( (string) (int) $min_price ); ?>" max="<?php echo esc_attr( (string) (int) $max_price ); ?>" step="500000" value="<?php echo esc_attr( (string) (int) $max_price ); ?>" aria-label="حداکثر قیمت" data-hs-price-max>
							</div>
							<button type="button" class="hs-price-reset" data-hs-price-reset hidden><?php echo higer_shop_icon( 'reset', 12 ); // phpcs:ignore ?> بازنشانی محدوده قیمت</button>
							<?php if ( ! empty( $presets ) ) : ?>
							<div class="hs-presets">
								<?php foreach ( $presets as $pr ) : ?>
								<button type="button" class="hs-preset" data-hs-preset-min="<?php echo (int) $pr['min']; ?>" data-hs-preset-max="<?php echo (int) $pr['max']; ?>"><?php echo esc_html( $pr['label'] ); ?></button>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۴. دسته‌بندی و نوع هسته -->
					<?php if ( $is_cat_page ) : ?>
						<?php if ( ! empty( $categories ) ) : ?>
						<details class="hs-fgroup" open>
							<summary><span><?php echo higer_shop_icon( 'bed', 15 ); // phpcs:ignore ?> زیرمجموعه‌های <?php echo esc_html( $ctx['cat_name'] ); ?></span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
							<div class="hs-fbody">
								<ul class="hs-cat-tree">
									<li>
										<button type="button" class="hs-cat-row" data-hs-cat="<?php echo esc_attr( $ctx['category'] ); ?>" aria-pressed="true">
											<span class="hs-radio" aria-hidden="true"></span>
											<span class="hs-cat-name">همه <?php echo esc_html( $ctx['cat_name'] ); ?></span>
											<em class="hs-fcount" data-hs-count="cat:<?php echo esc_attr( $ctx['category'] ); ?>"><?php echo esc_html( $vis_fa ); ?></em>
										</button>
									</li>
									<?php foreach ( $categories as $cat ) : ?>
									<li style="--depth:<?php echo (int) $cat['depth']; ?>">
										<button type="button" class="hs-cat-row" data-hs-cat="<?php echo esc_attr( $cat['slug'] ); ?>" aria-pressed="false">
											<span class="hs-radio" aria-hidden="true"></span>
											<span class="hs-cat-name"><?php echo esc_html( $cat['name'] ); ?></span>
											<em class="hs-fcount" data-hs-count="cat:<?php echo esc_attr( $cat['slug'] ); ?>"><?php echo esc_html( $fa( $cat['count'] ) ); ?></em>
										</button>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php if ( '' !== $ctx['shop_url'] ) : ?>
								<a class="hs-cat-all-link" href="<?php echo esc_url( $ctx['shop_url'] ); ?>"><span>مشاهده همه محصولات فروشگاه</span><?php echo higer_shop_icon( 'chevron-left', 13 ); // phpcs:ignore ?></a>
								<?php endif; ?>
							</div>
						</details>
						<?php elseif ( count( $siblings ) > 1 || $parent_cat ) : ?>
						<details class="hs-fgroup">
							<summary><span><?php echo higer_shop_icon( 'bed', 15 ); // phpcs:ignore ?> دسته‌های مرتبط</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
							<div class="hs-fbody">
								<ul class="hs-cat-tree">
									<?php if ( $parent_cat && '' !== $parent_cat['url'] ) : ?>
									<li>
										<a class="hs-cat-row" href="<?php echo esc_url( $parent_cat['url'] ); ?>">
											<span class="hs-radio" aria-hidden="true"></span>
											<span class="hs-cat-name">همه <?php echo esc_html( $parent_cat['name'] ); ?></span>
											<em class="hs-fcount"><?php echo esc_html( $fa( $cat_cnt( $parent_cat ) ) ); ?></em>
										</a>
									</li>
									<?php endif; ?>
									<?php foreach ( $siblings as $sib ) : $is_cur = $sib['slug'] === $ctx['category']; ?>
									<li style="--depth:<?php echo $parent_cat ? 1 : 0; ?>">
										<a class="hs-cat-row" href="<?php echo esc_url( $sib['url'] ); ?>"<?php echo $is_cur ? ' aria-current="page"' : ''; ?>>
											<span class="hs-radio" aria-hidden="true"></span>
											<span class="hs-cat-name"><?php echo esc_html( $sib['name'] ); ?></span>
											<em class="hs-fcount"><?php echo esc_html( $fa( $cat_cnt( $sib ) ) ); ?></em>
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
								<?php if ( '' !== $ctx['shop_url'] ) : ?>
								<a class="hs-cat-all-link" href="<?php echo esc_url( $ctx['shop_url'] ); ?>"><span>همه محصولات فروشگاه</span><?php echo higer_shop_icon( 'chevron-left', 13 ); // phpcs:ignore ?></a>
								<?php endif; ?>
							</div>
						</details>
						<?php endif; ?>
					<?php elseif ( $categories ) : ?>
					<details class="hs-fgroup" open>
						<summary><span><?php echo higer_shop_icon( 'bed', 15 ); // phpcs:ignore ?> دسته‌بندی و ساختار</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody">
							<ul class="hs-cat-tree">
								<li>
									<button type="button" class="hs-cat-row" data-hs-cat="" aria-pressed="<?php echo '' === $ctx['category'] ? 'true' : 'false'; ?>">
										<span class="hs-radio" aria-hidden="true"></span>
										<span class="hs-cat-name">همه محصولات</span>
										<em class="hs-fcount" data-hs-count="cat:"><?php echo esc_html( $total_fa ); ?></em>
									</button>
								</li>
								<?php foreach ( $categories as $cat ) : ?>
								<li style="--depth:<?php echo (int) $cat['depth']; ?>">
									<button type="button" class="hs-cat-row" data-hs-cat="<?php echo esc_attr( $cat['slug'] ); ?>" aria-pressed="<?php echo $cat['slug'] === $ctx['category'] ? 'true' : 'false'; ?>">
										<span class="hs-radio" aria-hidden="true"></span>
										<span class="hs-cat-name"><?php echo esc_html( $cat['name'] ); ?></span>
										<em class="hs-fcount" data-hs-count="cat:<?php echo esc_attr( $cat['slug'] ); ?>"><?php echo esc_html( $fa( $cat['count'] ) ); ?></em>
									</button>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۵. درجه سفتی -->
					<?php if ( ! empty( $facets['firmness'] ) ) : ?>
					<details class="hs-fgroup" open>
						<summary><span><?php echo higer_shop_icon( 'gauge', 15 ); // phpcs:ignore ?> درجه سفتی</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-check-list">
							<?php foreach ( $facets['firmness'] as $f ) : $f_on = in_array( $f['slug'], $ctx['firmness'], true ); ?>
							<button type="button" class="hs-check-row" data-hs-facet="firmness" data-value="<?php echo esc_attr( $f['slug'] ); ?>" aria-pressed="<?php echo $f_on ? 'true' : 'false'; ?>">
								<span class="hs-box" aria-hidden="true"><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hs-check-label">
									<b><?php echo esc_html( $f['name'] ); ?></b>
									<?php if ( $f['level'] ) : ?><span class="hs-mini-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $scale_max; $i++ ) : ?><i<?php echo $i <= $f['level'] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?>
								</span>
								<em class="hs-fcount" data-hs-count="firmness:<?php echo esc_attr( $f['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۶. چیدمان لایه‌ها -->
					<?php if ( ! empty( $facets['layers'] ) ) : ?>
					<details class="hs-fgroup" open>
						<summary><span><?php echo higer_shop_icon( 'layers', 15 ); // phpcs:ignore ?> چیدمان لایه‌ها</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-check-list">
							<?php foreach ( $facets['layers'] as $l ) : $l_on = in_array( $l['slug'], $ctx['layer'], true ); ?>
							<button type="button" class="hs-check-row" data-hs-facet="layer" data-value="<?php echo esc_attr( $l['slug'] ); ?>" aria-pressed="<?php echo $l_on ? 'true' : 'false'; ?>">
								<span class="hs-box" aria-hidden="true"><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hs-check-label"><b><?php echo esc_html( $l['name'] ); ?></b></span>
								<em class="hs-fcount" data-hs-count="layer:<?php echo esc_attr( $l['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۷. مدت گارانتی -->
					<?php if ( ! empty( $facets['warranty'] ) ) : ?>
					<details class="hs-fgroup" open>
						<summary><span><?php echo higer_shop_icon( 'shield', 15 ); // phpcs:ignore ?> مدت گارانتی</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-pill-list">
							<?php foreach ( $facets['warranty'] as $w ) : $w_on = in_array( $w['slug'], $ctx['warranty'], true ); ?>
							<button type="button" class="hs-fpill" data-hs-facet="warranty" data-value="<?php echo esc_attr( $w['slug'] ); ?>" aria-pressed="<?php echo $w_on ? 'true' : 'false'; ?>">
								<b><?php echo esc_html( $w['name'] ); ?></b>
								<em data-hs-count="warranty:<?php echo esc_attr( $w['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۸. لایه ویژه -->
					<?php if ( ! empty( $facets['special'] ) ) : ?>
					<details class="hs-fgroup" open>
						<summary><span><?php echo higer_shop_icon( 'cloud', 15 ); // phpcs:ignore ?> لایه ویژه</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-check-list">
							<?php foreach ( $facets['special'] as $sl ) : $sl_on = in_array( $sl['slug'], $ctx['special'], true ); ?>
							<button type="button" class="hs-check-row" data-hs-facet="special" data-value="<?php echo esc_attr( $sl['slug'] ); ?>" aria-pressed="<?php echo $sl_on ? 'true' : 'false'; ?>">
								<span class="hs-box" aria-hidden="true"><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hs-check-label"><b><?php echo esc_html( $sl['name'] ); ?></b></span>
								<em class="hs-fcount" data-hs-count="special:<?php echo esc_attr( $sl['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۹. نوع فنر -->
					<?php if ( ! empty( $facets['spring'] ) ) : ?>
					<details class="hs-fgroup">
						<summary><span><?php echo higer_shop_icon( 'spring', 15 ); // phpcs:ignore ?> نوع فنر</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-check-list">
							<?php foreach ( $facets['spring'] as $sp ) : $sp_on = in_array( $sp['slug'], $ctx['spring'], true ); ?>
							<button type="button" class="hs-check-row" data-hs-facet="spring" data-value="<?php echo esc_attr( $sp['slug'] ); ?>" aria-pressed="<?php echo $sp_on ? 'true' : 'false'; ?>">
								<span class="hs-box" aria-hidden="true"><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hs-check-label"><b><?php echo esc_html( $sp['name'] ); ?></b></span>
								<em class="hs-fcount" data-hs-count="spring:<?php echo esc_attr( $sp['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۱۰. جنس پارچه -->
					<?php if ( ! empty( $facets['fabric'] ) ) : ?>
					<details class="hs-fgroup">
						<summary><span><?php echo higer_shop_icon( 'fabric', 15 ); // phpcs:ignore ?> جنس پارچه</span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-check-list">
							<?php foreach ( $facets['fabric'] as $fb ) : $fb_on = in_array( $fb['slug'], $ctx['fabric'], true ); ?>
							<button type="button" class="hs-check-row" data-hs-facet="fabric" data-value="<?php echo esc_attr( $fb['slug'] ); ?>" aria-pressed="<?php echo $fb_on ? 'true' : 'false'; ?>">
								<span class="hs-box" aria-hidden="true"><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hs-check-label"><b><?php echo esc_html( $fb['name'] ); ?></b></span>
								<em class="hs-fcount" data-hs-count="fabric:<?php echo esc_attr( $fb['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endif; ?>

					<!-- ۱۱. ویژگی‌های سفارشی آینده در ووکامرس -->
					<?php foreach ( $facets['extra'] as $ex ) : ?>
					<details class="hs-fgroup">
						<summary><span><?php echo esc_html( $ex['label'] ); ?></span><?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?></summary>
						<div class="hs-fbody hs-check-list">
							<?php foreach ( $ex['terms'] as $et ) : ?>
							<button type="button" class="hs-check-row" data-hs-extra="<?php echo esc_attr( $ex['tax'] ); ?>" data-value="<?php echo esc_attr( $et['slug'] ); ?>" aria-pressed="false">
								<span class="hs-box" aria-hidden="true"><?php echo higer_shop_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<span class="hs-check-label"><b><?php echo esc_html( $et['name'] ); ?></b></span>
								<em class="hs-fcount" data-hs-count="extra:<?php echo esc_attr( $ex['tax'] . ':' . $et['slug'] ); ?>"></em>
							</button>
							<?php endforeach; ?>
						</div>
					</details>
					<?php endforeach; ?>

					<!-- کارت راهنمای تشک‌سنج هیگر -->
					<?php if ( $show_finder ) : ?>
					<a class="hs-finder-cta" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>">
						<span class="hs-finder-ico" aria-hidden="true"><?php echo higer_shop_icon( 'sparkles', 20 ); // phpcs:ignore ?></span>
						<span class="hs-finder-copy">
							<b>تشک‌سنج هیگر</b>
							<small><?php echo esc_html( '' !== $ctx['finder_text'] ? $ctx['finder_text'] : 'مطمئن نیستید کدام مدل مناسب شماست؟ با چند سؤال بررسی کنید' ); ?></small>
						</span>
						<span class="hs-finder-go">شروع <?php echo higer_shop_icon( 'chevron-left', 14 ); // phpcs:ignore ?></span>
					</a>
					<?php endif; ?>
				</div>

				<div class="hs-sidebar-foot">
					<button type="button" class="hs-btn-gold hs-drawer-apply" data-hs-drawer-close>مشاهده <span data-hs-result-num><?php echo esc_html( $total_fa ); ?></span> محصول</button>
				</div>
			</aside>

			<!-- ===== بخش نتایج و کارت‌های محصول ===== -->
			<div class="hs-content">
				<!-- نوار بالای لیست در دسکتاپ -->
				<div class="hs-toolbar">
					<div class="hs-result-meta" role="status" aria-live="polite">
						<span>نمایش <b data-hs-shown-count><?php echo esc_html( $vis_fa ); ?></b> از <?php echo esc_html( $total_fa ); ?> <?php echo $is_cat_page ? esc_html( 'محصول در ' . $ctx['cat_name'] ) : 'محصول'; ?></span>
						<span class="hs-size-banner" data-hs-size-banner hidden></span>
					</div>
					<div class="hs-toolbar-end">
						<label class="hs-sort-box">
							<span>مرتب‌سازی:</span>
							<select data-hs-sort>
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
						<div class="hs-view-switch" role="group" aria-label="حالت نمایش">
							<button type="button" data-hs-view="grid" aria-pressed="true" aria-label="نمایش شبکه‌ای"><?php echo higer_shop_icon( 'grid', 16 ); // phpcs:ignore ?></button>
							<button type="button" data-hs-view="list" aria-pressed="false" aria-label="نمایش فهرستی"><?php echo higer_shop_icon( 'list', 16 ); // phpcs:ignore ?></button>
						</div>
					</div>
				</div>

				<!-- نوار چسبنده فیلترهای فعال -->
				<div class="hs-active-bar" data-hs-active-bar hidden>
					<div class="hs-active-bar-inner">
						<div class="hs-active-chips" data-hs-active-chips></div>
						<button type="button" class="hs-clear-all" data-hs-reset>پاک کردن همه فیلترها</button>
					</div>
				</div>

				<!-- شبکه کارت‌های محصولات (رندر سمت سرور برای سئو + فیلتر آنی) -->
				<div class="hs-grid" data-hs-grid data-view="grid">
					<?php foreach ( $products as $p ) :
						$c_key = $p['core']['key'];
						$p_cat = $p['primaryCat'] ? $p['primaryCat']['name'] : '';
						?>
					<article class="hs-card<?php echo $p['inStock'] ? '' : ' is-out'; ?>" data-hs-card="<?php echo (int) $p['id']; ?>"<?php echo ( ! $p['inStock'] && $hide_out ) ? ' hidden' : ''; ?>>
						<div class="hs-card-media">
							<a class="hs-card-img-link" href="<?php echo esc_url( $p['url'] ); ?>" data-hs-link="<?php echo (int) $p['id']; ?>">
								<?php if ( '' !== $p['image'] ) : ?>
								<img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( '' !== $p['short'] ? $p['short'] : $p['name'] ); ?>" loading="lazy" decoding="async">
								<?php else : ?>
								<span class="hs-card-svg-wrap"><?php echo higer_shop_core_svg( $c_key ); // phpcs:ignore ?></span>
								<?php endif; ?>
							</a>
							<div class="hs-card-badges">
								<?php if ( '' !== $p_cat ) : ?><span class="hs-pill-cat"><?php echo esc_html( $p_cat ); ?></span><?php endif; ?>
								<?php if ( $p['warranty'] ) : ?><span class="hs-pill-war"><?php echo higer_shop_icon( 'shield', 12 ); // phpcs:ignore ?> گارانتی <?php echo esc_html( $p['warranty']['name'] ); ?></span><?php endif; ?>
								<?php if ( ! $p['inStock'] ) : ?><span class="hs-pill-out">ناموجود</span><?php elseif ( $p['onSale'] ) : ?><span class="hs-pill-sale">تخفیف</span><?php endif; ?>
							</div>
							<button type="button" class="hs-card-cmp-ico" data-hs-cmp="<?php echo (int) $p['id']; ?>" aria-pressed="false" aria-label="<?php echo esc_attr( 'افزودن ' . $p['name'] . ' به مقایسه' ); ?>">
								<span class="hs-cmp-off"><?php echo higer_shop_icon( 'compare', 13 ); // phpcs:ignore ?> مقایسه</span>
								<span class="hs-cmp-on"><?php echo higer_shop_icon( 'check', 13 ); // phpcs:ignore ?> در مقایسه</span>
							</button>
						</div>

						<div class="hs-card-body">
							<div class="hs-card-head">
								<h2 class="hs-card-title"><a href="<?php echo esc_url( $p['url'] ); ?>" data-hs-link="<?php echo (int) $p['id']; ?>"><?php echo esc_html( $p['name'] ); ?></a></h2>
								<?php if ( '' !== $p['short'] ) : ?><p class="hs-card-sub"><?php echo esc_html( $p['short'] ); ?></p><?php endif; ?>
							</div>

							<ul class="hs-card-specs" aria-label="ویژگی‌های کلیدی">
								<?php if ( '' !== $p['core']['title'] && 'accessory' !== $c_key ) : ?>
								<li><?php echo higer_shop_icon( 'bed', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $p['core']['title'] ); ?></span></li>
								<?php endif; ?>
								<?php if ( $p['firmness'] ) : ?>
								<li>
									<?php echo higer_shop_icon( 'gauge', 12 ); // phpcs:ignore ?>
									<span><?php echo esc_html( $p['firmness']['name'] ); ?></span>
									<?php if ( $p['firmness']['level'] ) : ?><span class="hs-mini-meter" aria-hidden="true"><?php for ( $i = 1; $i <= $scale_max; $i++ ) : ?><i<?php echo $i <= $p['firmness']['level'] ? ' class="is-on"' : ''; ?>></i><?php endfor; ?></span><?php endif; ?>
								</li>
								<?php endif; ?>
								<?php if ( $p['layer'] ) : ?>
								<li><?php echo higer_shop_icon( 'layers', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $p['layer']['name'] ); ?></span></li>
								<?php endif; ?>
								<?php foreach ( $p['special'] as $sl ) : ?>
								<li class="is-accent"><?php echo higer_shop_icon( 'cloud', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $sl['name'] ); ?></span></li>
								<?php endforeach; ?>
								<?php foreach ( $p['spring'] as $sp ) : ?>
								<li><?php echo higer_shop_icon( 'spring', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $sp['name'] ); ?></span></li>
								<?php endforeach; ?>
								<?php if ( '' !== $p['sizeSum'] ) : ?>
								<li><?php echo higer_shop_icon( 'ruler', 12 ); // phpcs:ignore ?> <span><?php echo esc_html( $p['sizeSum'] ); ?></span></li>
								<?php endif; ?>
							</ul>

							<div class="hs-card-price-box">
								<small data-hs-card-plabel="<?php echo (int) $p['id']; ?>"><?php echo esc_html( $p['max'] > $p['min'] ? 'محدوده قیمت' : 'قیمت' ); ?></small>
								<div class="hs-card-price-row">
									<strong data-hs-card-price="<?php echo (int) $p['id']; ?>"><?php echo esc_html( $p['rangeText'] ); ?></strong>
									<del data-hs-card-reg="<?php echo (int) $p['id']; ?>" hidden></del>
								</div>
							</div>

							<div class="hs-card-actions">
								<a class="hs-btn-primary" href="<?php echo esc_url( $p['url'] ); ?>" data-hs-link="<?php echo (int) $p['id']; ?>">مشاهده محصول <?php echo higer_shop_icon( 'chevron-left', 14 ); // phpcs:ignore ?></a>
								<?php if ( ! empty( $p['sizes'] ) ) : ?>
								<button type="button" class="hs-btn-sec" data-hs-quick="<?php echo (int) $p['id']; ?>"><?php echo higer_shop_icon( 'eye', 14 ); // phpcs:ignore ?> سایزها و قیمت</button>
								<?php endif; ?>
							</div>
						</div>
					</article>
					<?php endforeach; ?>
				</div>

				<!-- حالت بدون نتیجه -->
				<div class="hs-empty" data-hs-empty hidden>
					<div class="hs-empty-ico"><?php echo higer_shop_icon( 'search', 28 ); // phpcs:ignore ?></div>
					<h3>محصولی با این ترکیب از فیلترها پیدا نشد</h3>
					<p>می‌توانید برخی از فیلترها را بردارید یا همه فیلترها را پاک کنید تا دوباره تمام مدل‌ها نمایش داده شوند.</p>
					<div class="hs-empty-actions">
						<button type="button" class="hs-btn-gold" data-hs-reset><?php echo higer_shop_icon( 'reset', 16 ); // phpcs:ignore ?> پاک کردن همه فیلترها</button>
						<?php if ( $is_cat_page && '' !== $ctx['shop_url'] ) : ?><a class="hs-btn-sec" href="<?php echo esc_url( $ctx['shop_url'] ); ?>">مشاهده همه محصولات فروشگاه</a><?php elseif ( $show_finder ) : ?><a class="hs-btn-sec" href="<?php echo esc_url( home_url( $cfg['finder_path'] ) ); ?>"><?php echo higer_shop_icon( 'sparkles', 16 ); // phpcs:ignore ?> راهنمای تشک‌سنج</a><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $is_cat_page && '' !== $ctx['long_desc'] ) : ?>
	<!-- ===== راهنمای تکمیلی و سئوی دسته‌بندی (از توضیحات دسته در ووکامرس) ===== -->
	<section class="hs-cat-guide-sec" aria-label="راهنمای <?php echo esc_attr( $ctx['cat_name'] ); ?>">
		<div class="hs-wrap">
			<div class="hs-cat-guide">
				<span class="hs-kicker">درباره این دسته‌بندی</span>
				<h2 class="hs-cat-guide-title">راهنمای خرید <?php echo esc_html( $ctx['cat_name'] ); ?></h2>
				<div class="hs-cat-guide-body is-clamped" data-hs-guide-body><?php echo $ctx['long_desc']; // phpcs:ignore ?></div>
				<button type="button" class="hs-cat-guide-btn" data-hs-guide-toggle aria-expanded="false">
					<span>مطالعه کامل راهنمای دسته</span>
					<?php echo higer_shop_icon( 'chevron-down', 15 ); // phpcs:ignore ?>
				</button>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== نوار تماس پایین صفحه ===== -->
	<section class="hs-cta">
		<div class="hs-wrap hs-cta-inner">
			<div>
				<span class="hs-kicker is-dark">مشاوره خرید</span>
				<?php if ( $is_cat_page ) : ?>
				<h2>برای انتخاب بهترین مدل <span class="hs-gold-text"><?php echo esc_html( $ctx['cat_name'] ); ?></span> راهنمایی می‌خواهید؟</h2>
				<?php else : ?>
				<h2>برای انتخاب سایز یا مدل نیاز به <span class="hs-gold-text">راهنمایی</span> دارید؟</h2>
				<?php endif; ?>
				<p><?php echo higer_shop_icon( 'map', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['address'] ); ?></p>
				<p><?php echo higer_shop_icon( 'clock', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['hours'] ); ?></p>
			</div>
			<a class="hs-btn-gold" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_shop_icon( 'phone', 18 ); // phpcs:ignore ?> <?php echo esc_html( $store['phone'] ); ?></a>
		</div>
	</section>

	<!-- ===== نوار شناور مقایسه (مشترک با صفحه تک‌محصول) ===== -->
	<div class="hs-cmp-dock" data-hs-cmp-dock hidden>
		<div class="hs-cmp-dock-info">
			<span class="hs-cmp-dock-ico"><?php echo higer_shop_icon( 'compare', 16 ); // phpcs:ignore ?></span>
			<div>
				<b>فهرست مقایسه <span data-hs-cmp-count>(۰)</span></b>
				<div class="hs-cmp-dock-pills" data-hs-cmp-pills></div>
			</div>
		</div>
		<div class="hs-cmp-dock-actions">
			<button type="button" class="hs-cmp-clear" data-hs-cmp-clear>پاک کردن</button>
			<button type="button" class="hs-btn-gold" data-hs-cmp-open>مقایسه جدول کامل</button>
		</div>
	</div>

	<!-- ===== مودال مشاهده سریع سایزها و خرید مستقیم ===== -->
	<div class="hs-modal" data-hs-quick-modal hidden role="dialog" aria-modal="true" aria-label="مشاهده سریع سایزها و قیمت">
		<div class="hs-modal-backdrop" data-hs-modal-close></div>
		<div class="hs-modal-card hs-quick-card" data-hs-quick-body></div>
	</div>

	<!-- ===== مودال جدول مقایسه کامل مدل‌ها ===== -->
	<div class="hs-modal" data-hs-cmp-modal hidden role="dialog" aria-modal="true" aria-label="جدول مقایسه محصولات">
		<div class="hs-modal-backdrop" data-hs-modal-close></div>
		<div class="hs-modal-card hs-cmp-card">
			<div class="hs-modal-head">
				<div>
					<span class="hs-kicker"><?php echo higer_shop_icon( 'compare', 13 ); // phpcs:ignore ?> مقایسه مشخصات و قیمت</span>
					<h3>مقایسه مدل‌های انتخابی</h3>
				</div>
				<div class="hs-cmp-modal-tools">
					<label class="hs-cmp-size-pick">
						<span>قیمت در سایز:</span>
						<select data-hs-cmp-size>
							<option value="">محدوده قیمت</option>
							<?php $cmp_sizes = ! empty( $catalog['facets']['sizes'] ) ? $catalog['facets']['sizes'] : $facets['sizes']; foreach ( $cmp_sizes as $sz ) : ?>
							<option value="<?php echo esc_attr( $sz['slug'] ); ?>"><?php echo esc_html( $sz['label'] . ( '' !== $sz['sub'] ? ' (' . $sz['sub'] . ')' : '' ) ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<button type="button" class="hs-modal-close" data-hs-modal-close aria-label="بستن"><?php echo higer_shop_icon( 'close', 18 ); // phpcs:ignore ?></button>
				</div>
			</div>
			<div class="hs-modal-scroll" data-hs-cmp-table-wrap></div>
		</div>
	</div>
</div>
<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_shop' ) ) {
	add_shortcode( 'higer_shop', 'higer_shop_render' );
}

if ( ! function_exists( 'higer_shop_is_elementor_preview' ) ) {
	/** جلوگیری از تداخل هنگام باز کردن ویرایشگر المنتور. */
	function higer_shop_is_elementor_preview() {
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

if ( ! function_exists( 'higer_shop_archive_already_has_shortcode' ) ) {
	/** اگر قالب Product Archive المنتور خودش شورت‌کد [higer_shop] را دارد، دوباره رندر نشود. */
	function higer_shop_archive_already_has_shortcode() {
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
				if ( false !== strpos( $data, '[higer_shop' ) ) {
					return true;
				}
				$post = function_exists( 'get_post' ) ? get_post( $doc_id ) : null;
				if ( $post && ! empty( $post->post_content ) && false !== strpos( (string) $post->post_content, '[higer_shop' ) ) {
					return true;
				}
			}
		} catch ( \Throwable $e ) {
			return false;
		}
		return false;
	}
}

if ( ! function_exists( 'higer_shop_auto_replace' ) ) {
	/**
	 * جایگزینی خودکار صفحات دسته‌بندی ووکامرس (/product-category/...) با حفظ کامل هدر و فوتر سایت
	 * (حتی در صورت وجود قالب قدیمی Product Archive در المنتور پرو، و بدون دوباره‌کاری اگر شورت‌کد [higer_shop]
	 * داخل قالب المنتور گذاشته شده باشد).
	 */
	function higer_shop_auto_replace() {
		if ( is_admin() || ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || is_feed() || ( function_exists( 'is_embed' ) && is_embed() ) || is_404() ) {
			return;
		}
		$cfg = higer_shop_config();

		/* ۱. صفحات دسته‌بندی محصول (/product-category/...) */
		$is_cat = function_exists( 'is_product_category' ) && is_product_category();
		if ( $is_cat && ! empty( $cfg['auto_replace_categories'] ) && ! higer_shop_is_elementor_preview() ) {
			$term = function_exists( 'get_queried_object' ) ? get_queried_object() : null;
			if ( is_object( $term ) && isset( $term->taxonomy ) && 'product_cat' === $term->taxonomy && ! higer_shop_archive_already_has_shortcode() ) {
				add_filter( 'body_class', function ( $classes ) use ( $term ) {
					$classes[] = 'higer-shop-cat-archive';
					$classes[] = 'higer-shop-cat-' . sanitize_html_class( (string) $term->slug );
					return $classes;
				} );
				if ( function_exists( 'get_header' ) && function_exists( 'get_footer' ) ) {
					get_header( 'shop' );
					echo '<main id="content" class="site-main higer-shop-archive-main" role="main">';
					echo higer_shop_render(); // phpcs:ignore
					echo '</main>';
					get_footer( 'shop' );
					exit;
				}
			}
		}

		/* ۲. حالت بدون المنتور برای صفحه اصلی فروشگاه و سایر آرشیوهای محصول */
		if ( empty( $cfg['auto_replace'] ) ) {
			return;
		}
		$is_shop_page = ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() );
		if ( ! $is_shop_page ) {
			return;
		}
		remove_all_actions( 'woocommerce_before_shop_loop' );
		remove_all_actions( 'woocommerce_shop_loop' );
		remove_all_actions( 'woocommerce_after_shop_loop' );
		remove_all_actions( 'woocommerce_no_products_found' );
		add_filter( 'woocommerce_product_loop_start', '__return_empty_string', 99 );
		add_filter( 'woocommerce_product_loop_end', '__return_empty_string', 99 );
		add_action( 'woocommerce_before_main_content', 'higer_shop_auto_output', 25 );
	}
	function higer_shop_auto_output() {
		echo higer_shop_render(); // phpcs:ignore
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'template_redirect', 'higer_shop_auto_replace', 20 );
	}
}
