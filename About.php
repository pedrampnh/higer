<?php
/**
 * Higer About — صفحه «درباره ما» تشک هیگر | نسخه بدون بیلد (v1.2)
 * =====================================================================
 * اسنیپت PHP مستقل برای افزونه WPCode، هم‌خانواده با Home Page.php،
 * Shop Page.php، Single Product Page.php و هدر/فوتر اختصاصی هیگر.
 *
 * ─── نصب در WPCode ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل این فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *  ۴. Save و Activate
 *
 * ─── نمایش در برگه «درباره ما» (/about/) ───
 *  با المنتور: محتوای قبلی برگه را حذف کنید و یک ویجت Shortcode در یک بخش
 *  تمام‌عرض قرار دهید:            [higer_about]
 *  بدون المنتور: در تنظیمات پایین 'auto_content' را true کنید تا محتوای برگه
 *  با نامک 'about' خودکار جایگزین شود.
 *
 * ─── شورت‌کدها ───
 *  [higer_about]                 صفحه کامل
 *  [higer_about cores="no"]      بدون بخش چهار ساختار هسته
 *  [higer_about fullwidth="no"]  بدون حالت تمام‌عرض
 *
 * ─── ویرایش محتوا ───
 *  همه متن‌ها (داستان برند، خط زمانی، اصول، آمار و تعهدات) در تابع
 *  higer_about_config() جمع شده‌اند. متن‌های پیش‌فرض دقیقاً از صفحه فعلی
 *  «درباره ما» سایت برداشته شده‌اند.
 *  اگر Footer.php هیگر فعال باشد، بنر مشاوره فوتر در این صفحه خودکار پنهان می‌شود
 *  (چون انتهای همین صفحه بخش تعهد و دعوت به تماس دارد).
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_about_config' ) ) :
function higer_about_config() {
	$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';

	return array(

		/* --- برند --- */
		'brand' => array(
			'name'          => 'تشک هیگر',
			'en'            => 'HIGER MATTRESS',
			'est_fa'        => '۱۳۸۷',
			'reg_fa'        => '۱۳۹۷',
			'founding_year' => '2008', // برای داده ساختاریافته
			'use_wp_logo'   => true,
			'logo_url'      => 'https://higermattress.ir/wp-content/uploads/2026/08/logo-600x343.webp',
			'origin'        => 'بابل، مازندران',
		),

		/* --- تصاویر --- */
		'images' => array(
			'story' => 'https://higermattress.ir/wp-content/uploads/2026/11/higer-factory.webp', // تصویر بخش داستان (خالی = پس‌زمینه گرافیکی)
		),

		/* --- فروشگاه و تماس --- */
		'store' => array(
			'phone'     => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'       => 'tel:+989111186485',
			'address'   => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی ۲۷، فروشگاه و دفتر مرکزی هیگر',
			'hours'     => 'همه‌روزه به‌جز روزهای تعطیل، ساعت ۹ الی ۲۱',
			'map_query' => 'GMVQ+6X Babol, Mazandaran Province, Iran',
			'lat'       => 36.543063,
			'lng'       => 52.689938,
			'map_url'   => '', // اختیاری: لینک دلخواه گوگل‌مپ؛ خالی = ساخت خودکار از map_query
			'neshan_url'=> '', // اختیاری: لینک دلخواه نشان؛ خالی = ساخت خودکار از lat/lng
		),

		/* --- پیام‌رسان‌ها و شبکه‌های اجتماعی (در کارت شوروم انتهای صفحه) ---
		   واتساپ: wa.me/شماره با کد کشور (بدون صفر و +) | تلگرام: t.me/+شماره یا t.me/نام‌کاربری
		   profile = true یعنی نشانی یک صفحه عمومی است و در داده ساختاریافته (sameAs) هم ثبت می‌شود.
		   برای پنهان‌کردن هر مورد، مقدار url آن را خالی بگذارید. */
		'socials' => array(
			array( 'key' => 'whatsapp',  'label' => 'واتساپ',     'url' => 'https://wa.me/989111186485?text=' . rawurlencode( 'سلام، از سایت تشک هیگر پیام می‌دهم.' ) ),
			array( 'key' => 'telegram',  'label' => 'تلگرام',     'url' => 'https://t.me/+989111186485' ),
			array( 'key' => 'instagram', 'label' => 'اینستاگرام', 'url' => 'https://www.instagram.com/higer.mattress/', 'profile' => true ),
		),

		/* --- رفتار اسنیپت --- */
		'behavior' => array(
			'auto_content'        => false,   // true = جایگزینی خودکار محتوای برگه (بدون المنتور)
			'page_slug'           => 'about', // نامک برگه درباره ما
			'show_timeline'       => true,
			'show_cores'          => true,
			'structured_data'     => true,    // خروجی Schema.org (AboutPage + Organization)
			'suppress_footer_cta' => true,    // پنهان‌کردن بنر مشاوره Footer.php در این صفحه
		),

		/* --- سربرگ --- */
		'hero' => array(
			'kicker'  => 'داستان هیگر',
			'title_a' => 'تشک هیگر؛ ',
			'title_b' => 'از ۱۳۸۷ تا امروز',
			'lead'    => 'بیش از یک دهه حضور در صنعت تشک و تولید تخصصی با نام هیگر، با یک هدف روشن: خوابی راحت با کیفیتی درخور اعتماد.',
			'btn1'    => 'مشاهده محصولات',
			'btn1_url'=> $shop,
			'btn2'    => 'تماس با ما',
			'btn2_url'=> rtrim( $home, '/' ) . '/contact-us/',
			'card_title' => 'تولید تخصصی تشک در بابل',
			'card_sub'   => 'ثبت رسمی برند هیگر در سال ۱۳۹۷ پس از یک دهه تجربه در صنعت تشک',
		),

		/* --- نوار آمار زیر سربرگ --- */
		'stats' => array(
			array( 'value' => '۱۳۸۷', 'label' => 'آغاز فعالیت در صنعت تشک' ),
			array( 'value' => '۱۳۹۷', 'label' => 'ثبت رسمی برند هیگر' ),
			array( 'value' => '۴',    'label' => 'ساختار مهندسی هسته تشک' ),
			array( 'value' => '۹+',   'label' => 'سایز استاندارد و دوخت سفارشی' ),
		),

		/* --- داستان برند (متن اصلی صفحه درباره ما) --- */
		'story' => array(
			'kicker'     => 'ما که هستیم',
			'title_a'    => 'داستان ',
			'title_b'    => 'هیگر',
			'paragraphs' => array(
				'فعالیت ما در صنعت تشک از سال ۱۳۸۷ آغاز شد و طی سال‌ها فعالیت، تجربه و شناخت عمیقی از این صنعت به دست آوردیم. در سال ۱۳۹۷ با ثبت رسمی برند هیگر، تولید تخصصی تشک را آغاز کردیم.',
				'در طراحی و تولید محصولات، همواره تولیدات برترین برندهای تشک جهان را بررسی کرده‌ایم و با بهره‌گیری از استانداردها و فناوری‌های روز، محصولاتی باکیفیت و ماندگار ارائه می‌دهیم.',
				'هیگر با تنوع بالای محصولات، شامل تشک‌های فنر متصل، فنر منفصل، فوم سنگین و ریباند، تلاش می‌کند برای هر سلیقه و بودجه‌ای گزینه‌ای مناسب فراهم کند.',
			),
			'quote'      => 'هدف ما ارائه خوابی راحت با کیفیتی درخور اعتماد است.',
			'caption'    => 'HIGER MATTRESS • تولید تخصصی تشک',
		),

		/* --- خط زمانی --- */
		'timeline' => array(
			array( 'year' => '۱۳۸۷', 'title' => 'آغاز فعالیت در صنعت تشک', 'desc' => 'شروع مسیر با فعالیت در صنعت تشک و کسب تجربه و شناخت عمیق از نیازهای واقعی خواب خانواده‌های ایرانی.' ),
			array( 'year' => '۱۳۹۷', 'title' => 'ثبت رسمی برند هیگر', 'desc' => 'آغاز تولید تخصصی تشک با نام هیگر، با تمرکز بر استانداردها و فناوری‌های روز و بررسی تولیدات برترین برندهای جهان.' ),
			array( 'year' => 'امروز', 'title' => 'سبد کامل محصول و فروش آنلاین', 'desc' => 'تنوع در چهار ساختار هسته (فنر متصل، فنر منفصل، فوم سنگین و ریباند) همراه با تاپر، محافظ و تشک‌سنج هوشمند برای انتخاب دقیق‌تر.' ),
		),

		/* --- اصول کاری --- */
		'values' => array(
			array( 'icon' => 'globe',  'title' => 'الگوبرداری از برترین‌های جهان', 'desc' => 'در طراحی و تولید، همواره تولیدات برترین برندهای تشک جهان را بررسی و تحلیل می‌کنیم.' ),
			array( 'icon' => 'cog',    'title' => 'استاندارد و فناوری روز',       'desc' => 'بهره‌گیری از استانداردها و فناوری‌های روز برای محصولاتی باکیفیت و ماندگار.' ),
			array( 'icon' => 'layers', 'title' => 'تنوع برای هر سلیقه و بودجه',   'desc' => 'از تشک‌های فنر متصل و منفصل تا فوم سنگین و ریباند؛ گزینه‌ای مناسب برای هر نیاز.' ),
			array( 'icon' => 'shield', 'title' => 'کیفیت درخور اعتماد',           'desc' => 'گارانتی معتبر از تاریخ ثبت فاکتور و پشتیبانی مستقیم دفتر مرکزی هیگر.' ),
		),

		/* --- چهار ساختار هسته (کلید key را تغییر ندهید) --- */
		'cores' => array(
			array( 'key' => 'bonnell', 'title' => 'فنر متصل',        'en' => 'BONNELL SPRING',    'desc' => 'شبکه فنری یکپارچه و بادوام برای توزیع متوازن وزن در تمام سطح تشک.',        'url' => rtrim( $home, '/' ) . '/product-category/mattress/spring/bonnell-spring/' ),
			array( 'key' => 'pocket',  'title' => 'فنر منفصل پاکتی', 'en' => 'POCKET SPRING',     'desc' => 'واکنش مستقل هر پاکت فنری به انحنای بدن بدون انتقال حرکت به سمت مقابل.',    'url' => rtrim( $home, '/' ) . '/product-category/mattress/spring/pocket-spring/' ),
			array( 'key' => 'rebond',  'title' => 'ریباند طبی',       'en' => 'REBOUNDED FOAM',    'desc' => 'ساختار متراکم فوم فشرده‌شده برای حمایت ارتوپدیک از ستون فقرات.',           'url' => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/rebound/' ),
			array( 'key' => 'foam',    'title' => 'فوم سنگین',        'en' => 'HIGH-DENSITY FOAM', 'desc' => 'هسته تمام‌فوم یکنواخت و بی‌صدا با ماندگاری طولانی در استفاده روزمره.',     'url' => rtrim( $home, '/' ) . '/product-category/mattress/no-spring/high-density-foam/' ),
		),

		/* --- بند پایانی: تعهد هیگر --- */
		'promise' => array(
			'kicker'   => 'تعهد هیگر',
			'title_a'  => 'خوابی راحت، ',
			'title_b'  => 'با کیفیتی درخور اعتماد',
			'lead'     => 'هر تشک هیگر با این تعهد به خانه شما می‌رسد:',
			'items'    => array(
				'گارانتی معتبر از تاریخ ثبت فاکتور',
				'۹ سایز استاندارد به‌همراه دوخت سفارشی ابعاد خاص',
				'پرداخت آنلاین با درگاه امن یا کارت‌به‌کارت',
				'مشاوره تخصصی حضوری و تلفنی پیش از خرید',
			),
			'btn1'     => 'شروع تشک‌سنج هوشمند',
			'btn1_url' => rtrim( $home, '/' ) . '/#hg-finder',
			'btn2'     => 'تماس با ما',
			'btn2_url' => rtrim( $home, '/' ) . '/contact-us/',
		),
	);
}
endif;

/* ============================================================
   بخش ۲ — توابع کمکی و دیاگرام‌های فنی
   ============================================================ */

if ( ! function_exists( 'higer_about_icon' ) ) {
	function higer_about_icon( $name, $size = 18 ) {
		$icons = array(
			'phone'   => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'pin'     => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
			'navigate'=> '<polygon points="3 11 22 2 13 21 11 13 3 11"/>',
			'clock'   => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
			'shield'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/>',
			'layers'  => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
			'globe'   => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
			'cog'     => '<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>',
			'award'   => '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>',
			'gem'     => '<path d="M12 3l2.4 5.6L20 11l-5.6 2.4L12 19l-2.4-5.6L4 11l5.6-2.4L12 3z"/>',
			'moon'    => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
			'whatsapp'  => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
			'telegram'  => '<path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>',
			'instagram' => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
			'check'   => '<path d="M20 6 9 17l-5-5"/>',
			'arrow-l' => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'quote'   => '<path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/>',
		);
		$path = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
		return '<svg class="ha-i" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* دیاگرام مقطع چهار هسته تشک (هماهنگ با Home Page.php و Header.php) */
if ( ! function_exists( 'higer_about_core_svg' ) ) {
	function higer_about_core_svg( $key ) {
		if ( 'bonnell' === $key ) {
			return '<svg viewBox="0 0 88 36" class="ha-core-svg" aria-hidden="true"><line x1="4" y1="5" x2="84" y2="5" stroke="#f3d98b" stroke-width="1.6" stroke-linecap="round" opacity=".8"/><line x1="4" y1="31" x2="84" y2="31" stroke="#f3d98b" stroke-width="1.6" stroke-linecap="round" opacity=".8"/><path d="M10 9l5 9-5 9M22 9l-5 9 5 9M34 9l5 9-5 9M46 9l-5 9 5 9M58 9l5 9-5 9M70 9l-5 9 5 9" stroke="#e7b95c" stroke-width="1.4" fill="none" stroke-linecap="round"/></svg>';
		}
		if ( 'pocket' === $key ) {
			return '<svg viewBox="0 0 88 36" class="ha-core-svg" aria-hidden="true"><rect x="6" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><rect x="26" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><rect x="46" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><rect x="66" y="6" width="16" height="24" rx="4" fill="rgba(243,217,139,.1)" stroke="#e7b95c" stroke-width="1.3"/><path d="M10 11c8 2-2 5 8 7-8 2 2 5-8 7M30 11c8 2-2 5 8 7-8 2 2 5-8 7M50 11c8 2-2 5 8 7-8 2 2 5-8 7M70 11c8 2-2 5 8 7-8 2 2 5-8 7" stroke="#d9a13b" stroke-width="1.2" fill="none"/></svg>';
		}
		if ( 'rebond' === $key ) {
			return '<svg viewBox="0 0 88 36" class="ha-core-svg" aria-hidden="true"><rect x="5" y="7" width="78" height="22" rx="5" fill="rgba(217,161,59,.12)" stroke="#e7b95c" stroke-width="1.4"/><circle cx="15" cy="15" r="2.6" fill="#f3d98b" opacity=".85"/><circle cx="27" cy="22" r="2.2" fill="#d9a13b"/><circle cx="40" cy="14" r="2.8" fill="#e7b95c"/><circle cx="52" cy="22" r="2.4" fill="#f3d98b" opacity=".8"/><circle cx="65" cy="15" r="2.6" fill="#d9a13b"/><circle cx="75" cy="21" r="2.1" fill="#f3d98b"/></svg>';
		}
		return '<svg viewBox="0 0 88 36" class="ha-core-svg" aria-hidden="true"><path d="M5 11c22-4 56 4 78-1v7c-22 5-56-3-78 1z" fill="rgba(243,217,139,.18)" stroke="#f3d98b" stroke-width="1.3"/><path d="M5 22c22-3 56 4 78 0v6c-22 4-56-3-78 0z" fill="rgba(217,161,59,.16)" stroke="#d9a13b" stroke-width="1.3"/></svg>';
	}
}

if ( ! function_exists( 'higer_about_logo_src' ) ) {
	function higer_about_logo_src( $cfg ) {
		if ( ! empty( $cfg['brand']['use_wp_logo'] ) && function_exists( 'get_theme_mod' ) ) {
			$logo_id = (int) get_theme_mod( 'custom_logo' );
			if ( $logo_id ) {
				$img = wp_get_attachment_image_url( $logo_id, 'medium_large' );
				if ( ! $img ) {
					$img = wp_get_attachment_image_url( $logo_id, 'full' );
				}
				if ( $img ) {
					return $img;
				}
			}
		}
		return ! empty( $cfg['brand']['logo_url'] ) ? $cfg['brand']['logo_url'] : '';
	}
}

/* ============================================================
   بخش ۳ — استایل و اسکریپت (فقط یک‌بار در هر صفحه چاپ می‌شود)
   ============================================================ */

if ( ! function_exists( 'higer_about_assets' ) ) {
	function higer_about_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		ob_start();
		?>
<style id="higer-about-styles">
/* ================== هیگر — استایل صفحه درباره ما (نسخه بدون بیلد) ================== */
.higer-about{
  --ha-navy-950:#070f1d;--ha-navy-900:#10243e;--ha-navy-800:#183250;--ha-navy-700:#1f3e63;--ha-navy-600:#2b4e77;
  --ha-gold-600:#c8892a;--ha-gold-500:#d9a13b;--ha-gold-400:#e7b95c;--ha-gold-300:#f3d98b;--ha-gold-200:#f8ead0;
  --ha-cream:#faf7ef;--ha-paper:#f3efe3;--ha-line:#e3ddcd;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--ha-navy-900);background:var(--ha-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-about *,.higer-about *::before,.higer-about *::after{box-sizing:border-box}
.higer-about :is(h1,h2,h3,h4,p,ul,ol,figure,blockquote){margin:0;padding:0;border:0}
.higer-about :is(h1,h2,h3,h4){font-family:inherit;color:inherit;letter-spacing:normal;text-transform:none;font-weight:900;line-height:1.5}
.higer-about :is(ul,ol){list-style:none}
.higer-about a{color:inherit;text-decoration:none;background:none}
.higer-about img{display:block;max-width:100%;height:auto;border:0}
.higer-about svg{flex:none;display:block}
.higer-about .ha-i{display:inline-block;vertical-align:middle}
.higer-about [id]{scroll-margin-top:110px}
.higer-about :focus-visible{outline:3px solid var(--ha-gold-600);outline-offset:3px}
.higer-about .ha-wrap{width:100%;max-width:1280px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-about .ha-wrap{padding-inline:24px}}
.higer-about .ha-sec{padding-block:56px}
@media(min-width:1024px){.higer-about .ha-sec{padding-block:80px}}

/* ---------- نشان‌ها و دکمه‌ها ---------- */
.higer-about .ha-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.78);color:var(--ha-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800;line-height:1.6}
.higer-about .ha-kicker.is-dark{background:rgba(7,15,29,.55);color:var(--ha-gold-300);border-color:rgba(217,161,59,.4)}
.higer-about .ha-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-about .ha-gold-text.on-light{background:linear-gradient(175deg,#d9a13b 0%,#c8892a 50%,#a86f1c 100%);-webkit-background-clip:text;background-clip:text}
.higer-about .ha-h2{margin-top:12px;font-size:26px}
@media(min-width:640px){.higer-about .ha-h2{font-size:34px}}
.higer-about .ha-lead{margin-top:10px;font-size:13.5px;line-height:2;color:var(--ha-navy-700);max-width:44rem}
.higer-about a.ha-btn-gold{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:8px;overflow:hidden;border-radius:9999px;padding:13px 24px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--ha-navy-900);font-size:13px;font-weight:900;line-height:1.4;white-space:nowrap;box-shadow:0 10px 24px rgba(217,161,59,.35),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .2s,filter .2s}
.higer-about a.ha-btn-gold:hover{color:var(--ha-navy-900);transform:translateY(-2px);filter:brightness(1.04)}
.higer-about a.ha-btn-gold::after{content:"";position:absolute;top:-60%;inset-inline-start:-80%;width:55%;height:220%;background:linear-gradient(105deg,transparent,rgba(255,255,255,.75),transparent);transform:skewX(-18deg);animation:ha-shimmer 3.6s ease-in-out infinite;pointer-events:none}
@keyframes ha-shimmer{0%,55%{inset-inline-start:-90%}100%{inset-inline-start:140%}}
.higer-about a.ha-btn-outline{display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(243,217,139,.42);color:var(--ha-gold-300);border-radius:9999px;padding:12px 22px;font-size:13px;font-weight:800;transition:all .25s}
.higer-about a.ha-btn-outline:hover{background:rgba(243,217,139,.1);border-color:rgba(243,217,139,.8);color:var(--ha-gold-200)}

/* ---------- سربرگ ---------- */
.higer-about .ha-hero{position:relative;overflow:hidden;padding-block:0 84px;background:radial-gradient(960px 440px at 85% -10%,rgba(217,161,59,.18),transparent 60%),radial-gradient(800px 420px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 48%,#16304f 100%);color:var(--ha-cream)}
.higer-about .ha-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-about .ha-hero>*{position:relative}
.higer-about .ha-crumbs{margin-bottom:36px;border-bottom:1px solid rgba(243,217,139,.16)}
.higer-about .ha-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:rgba(250,247,239,.74)}
.higer-about .ha-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-about .ha-crumbs li+li::before{content:"‹";color:var(--ha-gold-400);font-weight:900}
.higer-about .ha-crumbs a:hover{color:var(--ha-gold-300)}
.higer-about .ha-crumbs [aria-current]{color:#fff;font-weight:900}
.higer-about .ha-hero-grid{display:grid;gap:30px;align-items:center}
@media(min-width:1024px){.higer-about .ha-hero-grid{grid-template-columns:minmax(0,1.4fr) minmax(0,400px)}}
.higer-about .ha-hero-title{margin-top:14px;font-size:32px;line-height:1.4;color:#fff}
@media(min-width:640px){.higer-about .ha-hero-title{font-size:46px}}
.higer-about .ha-hero-sub{margin-top:12px;max-width:620px;font-size:14px;line-height:2.05;color:rgba(248,234,208,.86)}
.higer-about .ha-hero-actions{display:flex;flex-wrap:wrap;align-items:center;gap:12px;margin-top:24px}
.higer-about .ha-brand-card{position:relative;overflow:hidden;padding:26px 24px;border-radius:26px;border:1px solid rgba(243,217,139,.3);background:radial-gradient(360px 180px at 85% 0%,rgba(217,161,59,.24),transparent 70%),rgba(7,15,29,.52);box-shadow:0 26px 60px rgba(4,10,22,.45),inset 0 1px 0 rgba(255,255,255,.08);text-align:center}
.higer-about .ha-brand-card::before{content:"";position:absolute;inset:12px;border:1px solid rgba(243,217,139,.22);border-radius:18px;pointer-events:none}
.higer-about .ha-brand-logo{height:76px;width:auto;max-width:240px;margin:6px auto 0;object-fit:contain}
.higer-about .ha-brand-crest{display:inline-grid;place-items:center;width:64px;height:64px;margin-top:4px;border-radius:18px;border:1px solid rgba(243,217,139,.45);background:radial-gradient(circle at 30% 25%,rgba(236,196,112,.3),rgba(13,19,46,.8));color:var(--ha-gold-300);font-size:26px;font-weight:900}
.higer-about .ha-brand-en{display:block;margin-top:14px;font-size:10px;font-weight:800;letter-spacing:.22em;color:var(--ha-gold-300);opacity:.85}
.higer-about .ha-brand-card b{display:block;margin-top:8px;font-size:17px;font-weight:900;color:#fff}
.higer-about .ha-brand-card small{display:block;margin-top:6px;font-size:12px;line-height:1.9;color:rgba(250,247,239,.72)}
.higer-about .ha-brand-years{display:flex;justify-content:center;gap:10px;margin-top:16px;padding-top:14px;border-top:1px solid rgba(243,217,139,.18)}
.higer-about .ha-brand-years span{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:9999px;border:1px solid rgba(243,217,139,.3);font-size:11px;font-weight:800;color:var(--ha-gold-200)}

/* ---------- نوار آمار ---------- */
.higer-about .ha-stats{position:relative;z-index:2;margin-top:-50px}
.higer-about .ha-stats-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1px;overflow:hidden;border:1px solid var(--ha-line);border-radius:22px;background:var(--ha-line);box-shadow:0 20px 50px rgba(16,36,62,.1)}
@media(min-width:1024px){.higer-about .ha-stats-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
.higer-about .ha-stat{padding:22px 16px;background:#fff;text-align:center}
.higer-about .ha-stat b{display:block;font-size:30px;font-weight:900;line-height:1.2;color:var(--ha-navy-900)}
.higer-about .ha-stat span{display:block;margin-top:6px;font-size:11.5px;font-weight:700;color:var(--ha-navy-600)}

/* ---------- داستان ---------- */
.higer-about .ha-story-grid{display:grid;gap:30px;align-items:center}
@media(min-width:1024px){.higer-about .ha-story-grid{grid-template-columns:minmax(0,.95fr) minmax(0,1.05fr)}}
.higer-about .ha-figure{position:relative;overflow:hidden;border-radius:28px;background:var(--ha-navy-900);box-shadow:0 30px 70px rgba(16,36,62,.2)}
.higer-about .ha-figure::before{content:"";position:absolute;inset:14px;z-index:1;border:1px solid rgba(243,217,139,.45);border-radius:20px;pointer-events:none}
.higer-about .ha-figure img{width:100%;aspect-ratio:4/3;object-fit:cover}
.higer-about .ha-figure-ph{aspect-ratio:4/3;background:radial-gradient(520px 260px at 80% 0%,rgba(217,161,59,.22),transparent 70%),linear-gradient(160deg,#0b1a30,#16304f);background-image:linear-gradient(rgba(243,217,139,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.06) 1px,transparent 1px),linear-gradient(160deg,#0b1a30,#16304f);background-size:36px 36px,36px 36px,100% 100%}
.higer-about .ha-figcaption{position:absolute;bottom:14px;inset-inline:14px;z-index:2;display:flex;align-items:center;justify-content:space-between;gap:10px;padding:12px 16px;border-radius:14px;background:rgba(7,15,29,.72);backdrop-filter:blur(8px);color:var(--ha-cream);font-size:12px;font-weight:800}
.higer-about .ha-figcaption small{font-size:9.5px;letter-spacing:.14em;color:var(--ha-gold-300)}
.higer-about .ha-story-text p{margin-top:14px;font-size:13.5px;line-height:2.15;color:var(--ha-navy-700)}
.higer-about .ha-quote{display:flex;gap:14px;align-items:flex-start;margin-top:22px;padding:18px 20px;border-inline-start:3px solid var(--ha-gold-500);border-radius:18px 0 0 18px;background:#fff;box-shadow:0 14px 34px rgba(16,36,62,.06)}
.higer-about .ha-quote .ha-i{color:var(--ha-gold-500);margin-top:2px}
.higer-about .ha-quote p{margin:0;font-size:15px;font-weight:900;line-height:1.9;color:var(--ha-navy-900)}

/* ---------- خط زمانی ---------- */
.higer-about .ha-timeline{background:radial-gradient(1100px 520px at 85% -10%,rgba(217,161,59,.16),transparent 60%),radial-gradient(900px 600px at -15% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 45%,#16304f 100%);color:var(--ha-cream)}
.higer-about .ha-timeline .ha-h2{color:#fff}
.higer-about .ha-timeline .ha-lead{color:rgba(248,234,208,.8)}
.higer-about .ha-tl{position:relative;display:grid;gap:16px;margin-top:34px}
@media(min-width:900px){.higer-about .ha-tl{grid-template-columns:repeat(3,minmax(0,1fr));gap:20px;padding-top:26px}.higer-about .ha-tl::before{content:"";position:absolute;top:0;right:8%;left:8%;height:1px;background:linear-gradient(90deg,transparent,rgba(243,217,139,.55),transparent)}}
.higer-about .ha-tl-item{position:relative;padding:22px;border-radius:22px;border:1px solid rgba(243,217,139,.2);background:rgba(7,15,29,.45);transition:border-color .22s,transform .22s}
.higer-about .ha-tl-item:hover{border-color:rgba(217,161,59,.55);transform:translateY(-3px)}
@media(min-width:900px){.higer-about .ha-tl-item::before{content:"";position:absolute;top:-32px;right:50%;width:11px;height:11px;border-radius:50%;background:var(--ha-gold-400);box-shadow:0 0 0 5px rgba(217,161,59,.22);transform:translateX(50%)}}
.higer-about .ha-tl-year{display:inline-flex;align-items:center;padding:5px 14px;border-radius:9999px;background:linear-gradient(180deg,#ecc470,#c8892a);color:var(--ha-navy-900);font-size:12px;font-weight:900}
.higer-about .ha-tl-item h3{margin-top:14px;font-size:16px;color:#fff}
.higer-about .ha-tl-item p{margin-top:8px;font-size:12.5px;line-height:2;color:rgba(248,234,208,.8)}

/* ---------- اصول ---------- */
.higer-about .ha-values-grid{display:grid;gap:14px;margin-top:30px}
@media(min-width:640px){.higer-about .ha-values-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(min-width:1024px){.higer-about .ha-values-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
.higer-about .ha-value{padding:22px;border:1px solid var(--ha-line);border-radius:22px;background:#fff;box-shadow:0 14px 34px rgba(16,36,62,.05);transition:transform .22s,border-color .22s}
.higer-about .ha-value:hover{transform:translateY(-4px);border-color:var(--ha-gold-500)}
.higer-about .ha-value-ico{display:grid;place-items:center;width:46px;height:46px;border-radius:14px;background:var(--ha-navy-900);color:var(--ha-gold-400)}
.higer-about .ha-value h3{margin-top:14px;font-size:15px}
.higer-about .ha-value p{margin-top:8px;font-size:12.5px;line-height:2;color:var(--ha-navy-700)}

/* ---------- چهار ساختار هسته ---------- */
.higer-about .ha-cores{background:var(--ha-paper)}
.higer-about .ha-cores-grid{display:grid;gap:14px;margin-top:30px}
@media(min-width:640px){.higer-about .ha-cores-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(min-width:1024px){.higer-about .ha-cores-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
.higer-about a.ha-core{display:flex;flex-direction:column;overflow:hidden;border:1px solid var(--ha-line);border-radius:22px;background:#fff;box-shadow:0 14px 34px rgba(16,36,62,.05);transition:transform .22s,border-color .22s}
.higer-about a.ha-core:hover{transform:translateY(-4px);border-color:var(--ha-gold-500);color:inherit}
.higer-about .ha-core-top{display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 18px;background:linear-gradient(160deg,#0b1a30,#183250)}
.higer-about .ha-core-svg{width:150px;height:58px}
.higer-about .ha-core-en{font-size:9.5px;font-weight:800;letter-spacing:.14em;color:var(--ha-gold-300);opacity:.85}
.higer-about .ha-core-body{padding:16px 18px 6px}
.higer-about .ha-core-body b{display:block;font-size:15px;font-weight:900}
.higer-about .ha-core-body p{margin-top:8px;font-size:12px;line-height:1.95;color:var(--ha-navy-700)}
.higer-about .ha-core-link{display:flex;align-items:center;gap:6px;margin-top:auto;padding:12px 18px 16px;font-size:12px;font-weight:800;color:var(--ha-gold-600)}

/* ---------- تعهد هیگر ---------- */
.higer-about .ha-promise{padding-block:56px;background:radial-gradient(1100px 520px at 85% -10%,rgba(217,161,59,.16),transparent 60%),linear-gradient(160deg,#0b1a30 0%,#10243e 45%,#16304f 100%);color:var(--ha-cream)}
@media(min-width:1024px){.higer-about .ha-promise{padding-block:72px}}
.higer-about .ha-promise-grid{display:grid;gap:26px;align-items:center}
@media(min-width:1024px){.higer-about .ha-promise-grid{grid-template-columns:minmax(0,1.2fr) minmax(0,.8fr)}}
.higer-about .ha-promise .ha-h2{color:#fff}
.higer-about .ha-promise .ha-lead{color:rgba(248,234,208,.8)}
.higer-about .ha-promise-list{display:grid;gap:10px;margin-top:20px}
@media(min-width:640px){.higer-about .ha-promise-list{grid-template-columns:repeat(2,minmax(0,1fr))}}
.higer-about .ha-promise-list li{display:flex;align-items:flex-start;gap:10px;padding:12px 14px;border-radius:14px;border:1px solid rgba(243,217,139,.16);background:rgba(255,255,255,.05);font-size:12.5px;font-weight:700;line-height:1.8}
.higer-about .ha-promise-list .ha-i{flex:none;margin-top:3px;color:var(--ha-gold-400)}
.higer-about .ha-promise-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:22px}
.higer-about .ha-promise-card{padding:24px;border-radius:24px;border:1px solid rgba(243,217,139,.3);background:rgba(7,15,29,.5);box-shadow:0 24px 54px rgba(4,10,22,.4)}
.higer-about .ha-promise-card h3{display:flex;align-items:center;gap:8px;font-size:14px;color:var(--ha-gold-300)}
.higer-about .ha-promise-card p{display:flex;align-items:flex-start;gap:8px;margin-top:12px;font-size:12.5px;line-height:1.9;color:rgba(250,247,239,.82)}
.higer-about .ha-promise-card p .ha-i{flex:none;margin-top:4px;color:var(--ha-gold-400)}
.higer-about .ha-promise-card a.ha-phone{display:block;margin-top:14px;padding-top:14px;border-top:1px solid rgba(243,217,139,.18);font-size:24px;font-weight:900;color:#fff;direction:ltr;unicode-bidi:embed;text-align:right;transition:color .2s}
.higer-about .ha-promise-card a.ha-phone:hover{color:var(--ha-gold-300)}
.higer-about .ha-map-links{display:flex;flex-wrap:wrap;gap:8px;margin-top:12px}
.higer-about a.ha-map-link{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:9999px;border:1px solid rgba(243,217,139,.28);background:rgba(217,161,59,.08);font-size:11.5px;font-weight:800;color:var(--ha-gold-200);transition:border-color .2s,background .2s,transform .2s}
.higer-about a.ha-map-link:hover{border-color:var(--ha-gold-400);background:rgba(217,161,59,.18);color:var(--ha-gold-300);transform:translateY(-1px)}
.higer-about .ha-social{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin-top:14px;padding-top:14px;border-top:1px solid rgba(243,217,139,.18)}
.higer-about .ha-social>span{font-size:11.5px;font-weight:700;color:rgba(250,247,239,.72)}
.higer-about .ha-social-links{display:flex;flex-wrap:wrap;gap:8px}
.higer-about .ha-social-links a{display:inline-flex;align-items:center;gap:6px;padding:7px 12px;border-radius:9999px;border:1px solid rgba(243,217,139,.28);background:rgba(217,161,59,.08);font-size:11.5px;font-weight:800;color:var(--ha-gold-200);transition:border-color .2s,background .2s,transform .2s}
.higer-about .ha-social-links a:hover{border-color:var(--ha-gold-400);background:rgba(217,161,59,.18);color:var(--ha-gold-300);transform:translateY(-2px)}
@media(prefers-reduced-motion:reduce){.higer-about *,.higer-about *::before,.higer-about *::after{animation:none!important;transition:none!important}}
</style>

<script id="higer-about-script">
(function () {
  if (window.__higerAboutInit) return;
  window.__higerAboutInit = true;

  var FONTS = [
    'https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css',
    'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css'
  ];

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
    if (root.getAttribute('data-ha-mounted')) return;
    root.setAttribute('data-ha-mounted', '1');

    /* حالت تمام‌عرض حتی داخل ستون محدود المنتور */
    if (root.getAttribute('data-ha-fw') === 'yes') {
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

    /* نمایش نرم کارت‌ها هنگام ورود به دید (در صورت پشتیبانی مرورگر) */
    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      var items = root.querySelectorAll('.ha-tl-item, .ha-value, .ha-core, .ha-stat');
      Array.prototype.forEach.call(items, function (el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(14px)';
        el.style.transition = 'opacity .5s ease, transform .5s ease';
      });
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          var el = entry.target;
          el.style.opacity = '1';
          el.style.transform = 'none';
          io.unobserve(el);
          /* پس از پایان انیمیشن ورود، استایل‌های درون‌خطی پاک می‌شوند تا افکت hover کارت‌ها برقرار بماند */
          window.setTimeout(function () {
            el.style.opacity = '';
            el.style.transform = '';
            el.style.transition = '';
          }, 650);
        });
      }, { threshold: 0.12 });
      Array.prototype.forEach.call(items, function (el) { io.observe(el); });
    }
  }

  function init() {
    addFonts();
    Array.prototype.forEach.call(document.querySelectorAll('.higer-about'), mount);
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
</script>
		<?php
		return (string) ob_get_clean();
	}
}

/* ============================================================
   بخش ۴ — خروجی HTML و ثبت شورت‌کد [higer_about]
   ============================================================ */

if ( ! function_exists( 'higer_about_render' ) ) {
	function higer_about_render( $atts = array() ) {
		$atts = function_exists( 'shortcode_atts' )
			? shortcode_atts( array( 'fullwidth' => 'yes', 'cores' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_about' )
			: array( 'fullwidth' => 'yes', 'cores' => 'yes' );

		$cfg     = higer_about_config();
		$brand   = $cfg['brand'];
		$hero    = $cfg['hero'];
		$story   = $cfg['story'];
		$promise = $cfg['promise'];
		$store   = $cfg['store'];
		$beh     = $cfg['behavior'];

		$fullwidth  = 'no' !== strtolower( (string) $atts['fullwidth'] );
		$show_cores = 'no' !== strtolower( (string) $atts['cores'] ) && ! empty( $beh['show_cores'] );
		$uid        = 'ha-' . substr( md5( uniqid( 'higer-about', true ) ), 0, 6 );
		$home       = function_exists( 'home_url' ) ? home_url( '/' ) : '/';
		$logo_src   = higer_about_logo_src( $cfg );
		$map_q      = ! empty( $store['map_query'] ) ? $store['map_query'] : '';
		$map_url    = ! empty( $store['map_url'] )
			? $store['map_url']
			: ( '' !== $map_q ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $map_q ) : '' );
		$has_coords = isset( $store['lat'], $store['lng'] ) && is_numeric( $store['lat'] ) && is_numeric( $store['lng'] );
		$neshan_url = ! empty( $store['neshan_url'] )
			? $store['neshan_url']
			: ( $has_coords ? 'https://nshn.ir/?lat=' . rawurlencode( (string) $store['lat'] ) . '&lng=' . rawurlencode( (string) $store['lng'] ) : '' );

		if ( ! empty( $beh['suppress_footer_cta'] ) ) {
			$GLOBALS['higer_suppress_footer_cta'] = true;
		}

		ob_start();
		echo higer_about_assets(); // phpcs:ignore
		?>
<div class="higer-about" id="<?php echo esc_attr( $uid ); ?>" dir="rtl" lang="fa" data-ha-fw="<?php echo $fullwidth ? 'yes' : 'no'; ?>">

	<!-- ===== سربرگ ===== -->
	<section class="ha-hero">
		<div class="ha-wrap">
			<nav class="ha-crumbs" aria-label="مسیر صفحه">
				<ol>
					<li><a href="<?php echo esc_url( $home ); ?>">خانه</a></li>
					<li aria-current="page">درباره ما</li>
				</ol>
			</nav>
			<div class="ha-hero-grid">
				<div>
					<span class="ha-kicker is-dark"><?php echo higer_about_icon( 'gem', 13 ); // phpcs:ignore ?> <?php echo esc_html( $hero['kicker'] ); ?></span>
					<h1 class="ha-hero-title"><?php echo esc_html( $hero['title_a'] ); ?><span class="ha-gold-text"><?php echo esc_html( $hero['title_b'] ); ?></span></h1>
					<p class="ha-hero-sub"><?php echo esc_html( $hero['lead'] ); ?></p>
					<div class="ha-hero-actions">
						<a class="ha-btn-gold" href="<?php echo esc_url( $hero['btn1_url'] ); ?>"><?php echo esc_html( $hero['btn1'] ); ?> <?php echo higer_about_icon( 'arrow-l', 15 ); // phpcs:ignore ?></a>
						<a class="ha-btn-outline" href="<?php echo esc_url( $hero['btn2_url'] ); ?>"><?php echo higer_about_icon( 'phone', 14 ); // phpcs:ignore ?> <?php echo esc_html( $hero['btn2'] ); ?></a>
					</div>
				</div>
				<aside class="ha-brand-card" aria-label="شناسنامه برند">
					<?php if ( $logo_src ) : ?>
						<img class="ha-brand-logo" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( $brand['name'] ); ?>" loading="lazy" decoding="async">
					<?php else : ?>
						<span class="ha-brand-crest">H</span>
					<?php endif; ?>
					<span class="ha-brand-en"><?php echo esc_html( $brand['en'] ); ?></span>
					<b><?php echo esc_html( $hero['card_title'] ); ?></b>
					<small><?php echo esc_html( $hero['card_sub'] ); ?></small>
					<div class="ha-brand-years">
						<span><?php echo higer_about_icon( 'clock', 12 ); // phpcs:ignore ?> تأسیس <?php echo esc_html( $brand['est_fa'] ); ?></span>
						<span><?php echo higer_about_icon( 'award', 12 ); // phpcs:ignore ?> ثبت برند <?php echo esc_html( $brand['reg_fa'] ); ?></span>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<!-- ===== نوار آمار ===== -->
	<?php if ( ! empty( $cfg['stats'] ) ) : ?>
	<section class="ha-stats" aria-label="آمار هیگر">
		<div class="ha-wrap">
			<div class="ha-stats-grid">
				<?php foreach ( (array) $cfg['stats'] as $st ) : ?>
					<div class="ha-stat"><b><?php echo esc_html( $st['value'] ); ?></b><span><?php echo esc_html( $st['label'] ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== داستان برند ===== -->
	<section class="ha-sec" id="ha-story">
		<div class="ha-wrap ha-story-grid">
			<figure class="ha-figure">
				<?php if ( ! empty( $cfg['images']['story'] ) ) : ?>
					<img src="<?php echo esc_url( $cfg['images']['story'] ); ?>" alt="<?php echo esc_attr( $brand['name'] ); ?>" loading="lazy" decoding="async">
				<?php else : ?>
					<div class="ha-figure-ph"></div>
				<?php endif; ?>
				<figcaption class="ha-figcaption"><span><?php echo esc_html( $brand['name'] ); ?> — <?php echo esc_html( $brand['origin'] ); ?></span><small><?php echo esc_html( $story['caption'] ); ?></small></figcaption>
			</figure>
			<div class="ha-story-text">
				<span class="ha-kicker"><?php echo esc_html( $story['kicker'] ); ?></span>
				<h2 class="ha-h2"><?php echo esc_html( $story['title_a'] ); ?><span class="ha-gold-text on-light"><?php echo esc_html( $story['title_b'] ); ?></span></h2>
				<?php foreach ( (array) $story['paragraphs'] as $p ) : ?>
					<p><?php echo esc_html( $p ); ?></p>
				<?php endforeach; ?>
				<?php if ( ! empty( $story['quote'] ) ) : ?>
					<blockquote class="ha-quote"><?php echo higer_about_icon( 'quote', 20 ); // phpcs:ignore ?><p><?php echo esc_html( $story['quote'] ); ?></p></blockquote>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- ===== خط زمانی ===== -->
	<?php if ( ! empty( $beh['show_timeline'] ) && ! empty( $cfg['timeline'] ) ) : ?>
	<section class="ha-sec ha-timeline" id="ha-timeline">
		<div class="ha-wrap">
			<span class="ha-kicker is-dark"><?php echo higer_about_icon( 'clock', 12 ); // phpcs:ignore ?> مسیر هیگر</span>
			<h2 class="ha-h2">از تجربه تا <span class="ha-gold-text">تولید تخصصی</span></h2>
			<p class="ha-lead">ایستگاه‌های مهم مسیری که هیگر را به امروز رسانده است.</p>
			<ol class="ha-tl">
				<?php foreach ( (array) $cfg['timeline'] as $t ) : ?>
					<li class="ha-tl-item">
						<span class="ha-tl-year"><?php echo esc_html( $t['year'] ); ?></span>
						<h3><?php echo esc_html( $t['title'] ); ?></h3>
						<p><?php echo esc_html( $t['desc'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== اصول کاری ===== -->
	<?php if ( ! empty( $cfg['values'] ) ) : ?>
	<section class="ha-sec" id="ha-values">
		<div class="ha-wrap">
			<span class="ha-kicker">اصول ما</span>
			<h2 class="ha-h2">چه چیزی هیگر را <span class="ha-gold-text on-light">هیگر می‌کند؟</span></h2>
			<p class="ha-lead">چهار اصلی که در طراحی، تولید و پشتیبانی هر تشک هیگر رعایت می‌شود.</p>
			<div class="ha-values-grid">
				<?php foreach ( (array) $cfg['values'] as $v ) : ?>
					<article class="ha-value">
						<span class="ha-value-ico"><?php echo higer_about_icon( $v['icon'], 20 ); // phpcs:ignore ?></span>
						<h3><?php echo esc_html( $v['title'] ); ?></h3>
						<p><?php echo esc_html( $v['desc'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== چهار ساختار هسته ===== -->
	<?php if ( $show_cores && ! empty( $cfg['cores'] ) ) : ?>
	<section class="ha-sec ha-cores" id="ha-cores">
		<div class="ha-wrap">
			<span class="ha-kicker">محصولات هیگر</span>
			<h2 class="ha-h2">چهار ساختار <span class="ha-gold-text on-light">مهندسی هسته تشک</span></h2>
			<p class="ha-lead">برای هر سلیقه، وزن و بودجه‌ای، یکی از این چهار ساختار پاسخ مناسب‌تری دارد.</p>
			<div class="ha-cores-grid">
				<?php foreach ( (array) $cfg['cores'] as $core ) : ?>
					<a class="ha-core" href="<?php echo esc_url( $core['url'] ); ?>">
						<div class="ha-core-top"><?php echo higer_about_core_svg( $core['key'] ); // phpcs:ignore ?><span class="ha-core-en"><?php echo esc_html( $core['en'] ); ?></span></div>
						<div class="ha-core-body"><b><?php echo esc_html( $core['title'] ); ?></b><p><?php echo esc_html( $core['desc'] ); ?></p></div>
						<span class="ha-core-link">مشاهده مدل‌ها <?php echo higer_about_icon( 'arrow-l', 14 ); // phpcs:ignore ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== تعهد هیگر ===== -->
	<section class="ha-promise" id="ha-promise">
		<div class="ha-wrap ha-promise-grid">
			<div>
				<span class="ha-kicker is-dark"><?php echo higer_about_icon( 'shield', 12 ); // phpcs:ignore ?> <?php echo esc_html( $promise['kicker'] ); ?></span>
				<h2 class="ha-h2"><?php echo esc_html( $promise['title_a'] ); ?><span class="ha-gold-text"><?php echo esc_html( $promise['title_b'] ); ?></span></h2>
				<p class="ha-lead"><?php echo esc_html( $promise['lead'] ); ?></p>
				<ul class="ha-promise-list">
					<?php foreach ( (array) $promise['items'] as $item ) : ?>
						<li><?php echo higer_about_icon( 'check', 15 ); // phpcs:ignore ?><span><?php echo esc_html( $item ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<div class="ha-promise-actions">
					<a class="ha-btn-gold" href="<?php echo esc_url( $promise['btn1_url'] ); ?>"><?php echo higer_about_icon( 'moon', 15 ); // phpcs:ignore ?> <?php echo esc_html( $promise['btn1'] ); ?></a>
					<a class="ha-btn-outline" href="<?php echo esc_url( $promise['btn2_url'] ); ?>"><?php echo esc_html( $promise['btn2'] ); ?> <?php echo higer_about_icon( 'arrow-l', 14 ); // phpcs:ignore ?></a>
				</div>
			</div>
			<aside class="ha-promise-card">
				<h3><?php echo higer_about_icon( 'pin', 16 ); // phpcs:ignore ?> شوروم و دفتر مرکزی</h3>
				<p><?php echo higer_about_icon( 'pin', 13 ); // phpcs:ignore ?> <?php echo esc_html( $store['address'] ); ?></p>
				<p><?php echo higer_about_icon( 'clock', 13 ); // phpcs:ignore ?> <?php echo esc_html( $store['hours'] ); ?></p>
				<?php if ( '' !== $map_url || '' !== $neshan_url ) : ?>
				<div class="ha-map-links">
					<?php if ( '' !== $map_url ) : ?>
						<a class="ha-map-link" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_about_icon( 'navigate', 13 ); // phpcs:ignore ?> مسیریابی در گوگل‌مپ</a>
					<?php endif; ?>
					<?php if ( '' !== $neshan_url ) : ?>
						<a class="ha-map-link" href="<?php echo esc_url( $neshan_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_about_icon( 'pin', 13 ); // phpcs:ignore ?> نشان</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<a class="ha-phone" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo esc_html( $store['phone'] ); ?></a>
				<?php
				$ha_socials = array();
				foreach ( ( isset( $cfg['socials'] ) ? (array) $cfg['socials'] : array() ) as $ha_soc ) {
					if ( ! empty( $ha_soc['url'] ) ) {
						$ha_socials[] = $ha_soc;
					}
				}
				if ( $ha_socials ) : ?>
				<div class="ha-social">
					<span>همراه هیگر باشید</span>
					<div class="ha-social-links">
						<?php foreach ( $ha_socials as $ha_soc ) : ?>
							<a href="<?php echo esc_url( $ha_soc['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $ha_soc['label'] . ' ' . $brand['name'] ); ?>"><?php echo higer_about_icon( $ha_soc['key'], 14 ); // phpcs:ignore ?> <?php echo esc_html( $ha_soc['label'] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>
			</aside>
		</div>
	</section>

	<?php if ( ! empty( $beh['structured_data'] ) ) :
		$schema = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				array( '@type' => 'AboutPage', 'name' => 'درباره ' . $brand['name'], 'url' => ( function_exists( 'get_queried_object_id' ) && get_queried_object_id() ) ? get_permalink( get_queried_object_id() ) : $home ),
				array(
					'@type'        => 'Organization',
					'name'         => $brand['name'],
					'alternateName'=> $brand['en'],
					'url'          => $home,
					'logo'         => $logo_src,
					'foundingDate' => $brand['founding_year'],
					'telephone'    => str_replace( 'tel:', '', $store['tel'] ),
					'address'      => array( '@type' => 'PostalAddress', 'streetAddress' => $store['address'], 'addressLocality' => 'بابل', 'addressRegion' => 'مازندران', 'addressCountry' => 'IR' ),
				),
			),
		);
		/* صفحه‌های رسمی برند در شبکه‌های اجتماعی (فقط مواردی که profile = true دارند) */
		$same_as = array();
		foreach ( ( isset( $cfg['socials'] ) ? (array) $cfg['socials'] : array() ) as $ha_soc ) {
			if ( ! empty( $ha_soc['profile'] ) && ! empty( $ha_soc['url'] ) ) {
				$same_as[] = $ha_soc['url'];
			}
		}
		if ( $same_as ) {
			$schema['@graph'][1]['sameAs'] = $same_as;
		}
		?>
		<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
	<?php endif; ?>
</div>
		<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_about' ) ) {
	add_shortcode( 'higer_about', 'higer_about_render' );
}

/* حالت بدون المنتور: جایگزینی خودکار محتوای برگه درباره ما */
if ( ! function_exists( 'higer_about_auto_content' ) ) {
	function higer_about_auto_content( $content ) {
		$cfg = higer_about_config();
		if ( empty( $cfg['behavior']['auto_content'] ) || ! function_exists( 'is_page' ) || ! is_page( $cfg['behavior']['page_slug'] ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}
		return higer_about_render();
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'the_content', 'higer_about_auto_content', 20 );
	}
}
