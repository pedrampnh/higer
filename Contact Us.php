<?php
/**
 * Higer Contact — صفحه «تماس با ما» تشک هیگر | نسخه بدون بیلد (v1.2)
 * =====================================================================
 * اسنیپت PHP مستقل برای افزونه WPCode، هم‌خانواده با Home Page.php،
 * Shop Page.php، Single Product Page.php و هدر/فوتر اختصاصی هیگر.
 *
 * ─── نصب در WPCode ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل این فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *     (حتماً Run Everywhere؛ چون فرم تماس از admin-ajax.php استفاده می‌کند)
 *  ۴. Save و Activate
 *
 * ─── نمایش در برگه «تماس با ما» (/contact-us/) ───
 *  با المنتور: محتوای قبلی برگه را حذف کنید و یک ویجت Shortcode در یک بخش
 *  تمام‌عرض قرار دهید:            [higer_contact]
 *  بدون المنتور: در تنظیمات پایین 'auto_content' را true کنید تا محتوای برگه
 *  با نامک 'contact-us' خودکار جایگزین شود.
 *
 * ─── شورت‌کدها ───
 *  [higer_contact]                 صفحه کامل
 *  [higer_contact form="no"]       بدون فرم ارسال پیام
 *  [higer_contact map="no"]        بدون نقشه تعبیه‌شده (فقط کارت مسیریابی)
 *  [higer_contact fullwidth="no"]  بدون حالت تمام‌عرض
 *
 * ─── فرم تماس ───
 *  • ارسال بدون بارگذاری مجدد صفحه (AJAX) + پشتیبانی کامل از حالت بدون جاوااسکریپت
 *  • محافظت: هانی‌پات، تله زمانی، محدودیت نرخ ارسال بر اساس IP و (اختیاری) nonce
 *  • هر پیام هم به ایمیل مدیر ارسال می‌شود و هم در پیشخوان وردپرس در منوی
 *    «پیام‌های تماس» ذخیره می‌گردد تا حتی با خطای ایمیل، هیچ پیامی گم نشود.
 *  • اگر Footer.php هیگر فعال باشد، بنر مشاوره فوتر در این صفحه خودکار پنهان می‌شود.
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_contact_config' ) ) :
function higer_contact_config() {
	$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';

	return array(

		/* --- فروشگاه و دفتر مرکزی --- */
		'store' => array(
			'name'      => 'تشک هیگر',
			'phone'     => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'       => 'tel:+989111186485',
			'landline'  => '۰۱۱-۳۲۲۵۴۹۹۲',
			'land_tel'  => 'tel:+981132254992',
			'email'     => 'contact@higermattress.ir',
			'address'   => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی ۲۷، فروشگاه و دفتر مرکزی هیگر',
			'city'      => 'بابل',
			'province'  => 'مازندران',
			'hours'     => 'همه‌روزه به‌جز روزهای تعطیل، ساعت ۹ الی ۲۱',
			'opens'     => '09:00', // برای داده ساختاریافته گوگل
			'closes'    => '21:00',
			/* موقعیت دقیق شوروم (پلاس‌کد گوگل‌مپ + مختصات متناظر روی خیابان نواب صفوی بابل) */
			'map_query' => 'GMVQ+6X Babol, Mazandaran Province, Iran',
			'map_zoom'  => 16,
			'lat'       => 36.543063,
			'lng'       => 52.689938,
			'map_embed' => '', // اختیاری: src اختصاصی iframe نقشه؛ خالی = ساخت خودکار نقشه گوگل از map_query
			'map_url'   => '', // اختیاری: لینک دلخواه گوگل‌مپ؛ خالی = ساخت خودکار از map_query
			'neshan_url'=> '', // اختیاری: لینک دلخواه نشان؛ خالی = ساخت خودکار از lat/lng
			/* جدول ساعات کاری کنار فرم */
			'week'      => array(
				array( 'day' => 'شنبه تا چهارشنبه', 'hours' => '۹:۰۰ تا ۲۱:۰۰' ),
				array( 'day' => 'پنج‌شنبه',          'hours' => '۹:۰۰ تا ۲۱:۰۰' ),
				array( 'day' => 'جمعه',              'hours' => '۹:۰۰ تا ۲۱:۰۰' ),
				array( 'day' => 'تعطیلات رسمی',      'hours' => 'تعطیل', 'off' => true ),
			),
		),

		/* --- رفتار اسنیپت --- */
		'behavior' => array(
			'auto_content'        => false,        // true = جایگزینی خودکار محتوای برگه (بدون المنتور)
			'page_slug'           => 'contact-us', // نامک برگه تماس با ما
			'show_form'           => true,
			'show_map'            => true,         // نمایش نقشه زنده گوگل‌مپ در ستون کناری
			'structured_data'     => true,         // خروجی Schema.org (ContactPage + Store)
			'suppress_footer_cta' => true,         // پنهان‌کردن بنر مشاوره Footer.php در این صفحه
		),

		/* --- فرم تماس --- */
		'form' => array(
			'recipient'      => '',              // ایمیل گیرنده؛ خالی = ایمیل مدیر وردپرس
			'cc'             => array(),         // گیرندگان رونوشت (اختیاری)
			'subject_prefix' => '[تشک هیگر]',
			'store_messages' => true,            // ذخیره پیام‌ها در پیشخوان (منوی «پیام‌های تماس»)
			'use_nonce'      => false,           // اگر افزونه کش صفحه ندارید می‌توانید true کنید
			'min_interval'   => 60,              // حداقل فاصله دو ارسال از یک IP (ثانیه)
			'hourly_limit'   => 5,               // سقف ارسال در هر ساعت از یک IP
			'topics'         => array( 'مشاوره خرید تشک', 'پیگیری سفارش', 'گارانتی و خدمات پس از فروش', 'همکاری و نمایندگی', 'سایر موارد' ),
			'success'        => 'پیام شما با موفقیت ثبت شد. کارشناسان هیگر در اولین فرصت کاری با شما تماس می‌گیرند.',
			'title'          => 'پیام خود را برای ما بنویسید',
			'intro'          => 'فرم زیر را تکمیل کنید؛ در ساعات کاری معمولاً در کمتر از یک ساعت پاسخ می‌دهیم.',
		),

		/* --- سربرگ صفحه --- */
		'hero' => array(
			'kicker'   => 'ارتباط با هیگر',
			'title_a'  => 'تماس با ',
			'title_b'  => 'تشک هیگر',
			'subtitle' => 'برای مشاوره انتخاب تشک، پیگیری سفارش، شرایط گارانتی یا هماهنگی بازدید از شوروم، از هر کانالی که راحت‌ترید با ما در ارتباط باشید.',
			'status'   => 'امروز پاسخگوی شما هستیم',
			'phone_note' => 'خط مستقیم مشاوره و سفارش • پاسخگو در واتساپ و تلگرام',
		),

		/* --- شبکه‌های اجتماعی (فقط موارد دارای لینک نمایش داده می‌شوند) --- */
		'socials' => array(
			/* واتساپ: wa.me/شماره با کد کشور (بدون صفر و +) | تلگرام: t.me/+شماره یا t.me/نام‌کاربری
			   profile = true یعنی نشانی یک صفحه عمومی است و در داده ساختاریافته (sameAs) هم ثبت می‌شود. */
			array( 'key' => 'whatsapp',  'label' => 'واتساپ',     'cta' => 'گفتگو در واتساپ',  'handle' => '۰۹۱۱۱۱۸۶۴۸۵',    'url' => 'https://wa.me/989111186485?text=' . rawurlencode( 'سلام، از سایت تشک هیگر پیام می‌دهم.' ) ),
			array( 'key' => 'telegram',  'label' => 'تلگرام',     'cta' => 'گفتگو در تلگرام',  'handle' => '۰۹۱۱۱۱۸۶۴۸۵',    'url' => 'https://t.me/+989111186485' ),
			array( 'key' => 'instagram', 'label' => 'اینستاگرام', 'cta' => 'صفحه اینستاگرام', 'handle' => '@higer.mattress', 'url' => 'https://www.instagram.com/higer.mattress/', 'profile' => true ),
		),
		'socials_title' => 'گفتگوی آنلاین با هیگر',
		'socials_intro' => 'عکس تخت یا ابعاد موردنظرتان را بفرستید، قیمت سایز دلخواه را بپرسید یا سفارش خود را پیگیری کنید.',

		/* --- دسترسی سریع کنار فرم --- */
		'quick' => array(
			array( 'icon' => 'moon',  'title' => 'تشک‌سنج هوشمند', 'sub' => 'پیشنهاد مدل بر اساس وزن و حالت خواب', 'url' => rtrim( $home, '/' ) . '/#hg-finder' ),
			array( 'icon' => 'bag',   'title' => 'فروشگاه آنلاین',  'sub' => 'قیمت دقیق هر سایز و خرید مستقیم',    'url' => $shop ),
			array( 'icon' => 'shield','title' => 'گارانتی و خدمات', 'sub' => 'شروع گارانتی از تاریخ ثبت فاکتور',   'url' => rtrim( $home, '/' ) . '/#hg-faq' ),
		),

		/* --- سؤالات پرتکرار تماس --- */
		'faqs' => array(
			array( 'q' => 'ساعات پاسخگویی تلفنی چه زمانی است؟', 'a' => 'همه‌روزه به‌جز روزهای تعطیل از ساعت ۹ تا ۲۱ از طریق شماره‌های اعلام‌شده پاسخگوی شما هستیم.' ),
			array( 'q' => 'آیا در واتساپ و تلگرام هم پاسخگو هستید؟', 'a' => 'بله؛ شماره ۰۹۱۱۱۱۸۶۴۸۵ در واتساپ و تلگرام فعال است و می‌توانید عکس تخت یا ابعاد موردنظرتان را ارسال کنید. صفحه اینستاگرام هیگر هم با شناسه higer.mattress در دسترس است.' ),
			array( 'q' => 'برای بازدید حضوری از شوروم نیاز به هماهنگی قبلی هست؟', 'a' => 'خیر؛ در ساعات کاری می‌توانید به شوروم بابل مراجعه کنید. برای مشاوره تخصصی طولانی‌تر، هماهنگی تلفنی پیشنهاد می‌شود.' ),
			array( 'q' => 'چطور از زمان و هزینه ارسال به شهر خودم مطلع شوم؟', 'a' => 'برای اطلاع از شرایط ارسال به شهر خود با فروشگاه تماس بگیرید تا بر اساس مقصد و سایز تشک راهنمایی شوید.' ),
			array( 'q' => 'پرداخت چطور انجام می‌شود؟', 'a' => 'آنلاین با درگاه امن بانکی یا کارت‌به‌کارت.' ),
			array( 'q' => 'زمان شروع گارانتی تشک‌های هیگر؟', 'a' => 'گارانتی از تاریخ ثبت فاکتور آغاز می‌شود.' ),
			array( 'q' => 'امکان سفارش تشک با ابعاد غیراستاندارد وجود دارد؟', 'a' => 'بله؛ علاوه بر ۹ سایز استاندارد، امکان دوخت سفارشی برای ابعاد خاص نیز وجود دارد. برای استعلام قیمت تماس بگیرید.' ),
		),
	);
}
endif;

/* ============================================================
   بخش ۲ — توابع کمکی، ذخیره پیام‌ها و پردازش فرم
   ============================================================ */

if ( ! function_exists( 'higer_contact_fa' ) ) {
	function higer_contact_fa( $text ) {
		return strtr( (string) $text, array( '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹' ) );
	}
}

if ( ! function_exists( 'higer_contact_en_digits' ) ) {
	function higer_contact_en_digits( $text ) {
		return strtr( (string) $text, array(
			'۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
			'٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
		) );
	}
}

if ( ! function_exists( 'higer_contact_len' ) ) {
	function higer_contact_len( $text ) {
		return function_exists( 'mb_strlen' ) ? mb_strlen( (string) $text ) : strlen( (string) $text );
	}
}

if ( ! function_exists( 'higer_contact_icon' ) ) {
	function higer_contact_icon( $name, $size = 18 ) {
		$icons = array(
			'phone'      => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'smartphone' => '<rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>',
			'mail'       => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
			'pin'        => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
			'clock'      => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
			'copy'       => '<rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>',
			'check'      => '<path d="M20 6 9 17l-5-5"/>',
			'send'       => '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>',
			'arrow-l'    => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'navigate'   => '<polygon points="3 11 22 2 13 21 11 13 3 11"/>',
			'lock'       => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
			'moon'       => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
			'bag'        => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
			'shield'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/>',
			'chat'       => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
			'instagram'  => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
			'telegram'   => '<path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>',
			'whatsapp'   => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
		);
		$path = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
		return '<svg class="hc-i" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* نوع محتوای «پیام‌های تماس» برای نگهداری پیام‌ها در پیشخوان */
if ( ! function_exists( 'higer_contact_register_cpt' ) ) {
	function higer_contact_register_cpt() {
		$cfg = higer_contact_config();
		if ( empty( $cfg['form']['store_messages'] ) || ! function_exists( 'register_post_type' ) || post_type_exists( 'higer_message' ) ) {
			return;
		}
		register_post_type( 'higer_message', array(
			'labels'              => array(
				'name'          => 'پیام‌های تماس هیگر',
				'singular_name' => 'پیام تماس',
				'menu_name'     => 'پیام‌های تماس',
				'edit_item'     => 'مشاهده پیام',
				'search_items'  => 'جستجوی پیام',
				'not_found'     => 'پیامی ثبت نشده است.',
				'all_items'     => 'همه پیام‌ها',
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 26,
			'menu_icon'           => 'dashicons-email-alt',
			'supports'            => array( 'title', 'editor' ),
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'capabilities'        => array( 'create_posts' => 'do_not_allow' ),
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_in_rest'        => false,
		) );
	}
	if ( function_exists( 'add_action' ) ) {
		if ( did_action( 'init' ) ) {
			higer_contact_register_cpt();
		} else {
			add_action( 'init', 'higer_contact_register_cpt' );
		}
	}
}

/* اعتبارسنجی، ذخیره و ارسال ایمیل پیام */
if ( ! function_exists( 'higer_contact_process' ) ) {
	function higer_contact_process( $data ) {
		$cfg = higer_contact_config();
		$f   = $cfg['form'];
		$ok  = function ( $message ) { return array( 'ok' => true, 'message' => $message ); };
		$err = function ( $message ) { return array( 'ok' => false, 'message' => $message ); };

		/* nonce (اختیاری برای مهمان‌ها به دلیل کش صفحه، اجباری برای کاربران واردشده) */
		if ( ! empty( $f['use_nonce'] ) || is_user_logged_in() ) {
			$nonce = isset( $data['_hc_nonce'] ) ? sanitize_text_field( wp_unslash( $data['_hc_nonce'] ) ) : '';
			if ( ! $nonce || ! wp_verify_nonce( $nonce, 'higer_contact' ) ) {
				return $err( 'نشست شما منقضی شده است. لطفاً صفحه را تازه کنید و دوباره تلاش کنید.' );
			}
		}

		/* هانی‌پات: ربات‌ها این فیلد مخفی را پر می‌کنند */
		if ( ! empty( $data['hc_website'] ) ) {
			return $ok( $f['success'] );
		}

		/* تله زمانی: ارسال سریع‌تر از ۳ ثانیه مشکوک است */
		$started = isset( $data['hc_ts'] ) ? (int) $data['hc_ts'] : 0;
		if ( $started && ( time() - $started ) < 3 ) {
			return $err( 'ارسال خیلی سریع انجام شد. لطفاً چند لحظه صبر کنید و دوباره تلاش کنید.' );
		}

		/* محدودیت نرخ ارسال بر اساس IP */
		$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '0.0.0.0';
		$key = 'hc_rl_' . md5( $ip );
		$log = get_transient( $key );
		$log = is_array( $log ) ? $log : array();
		$now = time();
		$log = array_values( array_filter( $log, function ( $t ) use ( $now ) {
			return ( $now - (int) $t ) < HOUR_IN_SECONDS;
		} ) );
		if ( $log && ( $now - (int) end( $log ) ) < (int) $f['min_interval'] ) {
			return $err( 'پیام قبلی شما ثبت شده است. لطفاً یک دقیقه بعد دوباره تلاش کنید.' );
		}
		if ( count( $log ) >= (int) $f['hourly_limit'] ) {
			return $err( 'سقف ارسال پیام در یک ساعت تکمیل شده است. لطفاً تلفنی با ما در ارتباط باشید.' );
		}

		/* پاک‌سازی و اعتبارسنجی فیلدها */
		$name      = isset( $data['hc_name'] ) ? sanitize_text_field( wp_unslash( $data['hc_name'] ) ) : '';
		$phone_raw = isset( $data['hc_phone'] ) ? sanitize_text_field( wp_unslash( $data['hc_phone'] ) ) : '';
		$phone     = preg_replace( '/[^0-9+]/', '', higer_contact_en_digits( $phone_raw ) );
		$email     = isset( $data['hc_email'] ) ? sanitize_email( wp_unslash( $data['hc_email'] ) ) : '';
		$topic     = isset( $data['hc_topic'] ) ? sanitize_text_field( wp_unslash( $data['hc_topic'] ) ) : '';
		$message   = isset( $data['hc_message'] ) ? sanitize_textarea_field( wp_unslash( $data['hc_message'] ) ) : '';
		$page      = isset( $data['_hc_back'] ) ? esc_url_raw( wp_unslash( $data['_hc_back'] ) ) : '';

		if ( higer_contact_len( $name ) < 2 ) {
			return $err( 'لطفاً نام خود را وارد کنید.' );
		}
		if ( strlen( $phone ) < 8 || strlen( $phone ) > 15 ) {
			return $err( 'لطفاً یک شماره تماس معتبر وارد کنید.' );
		}
		if ( '' !== $email && ! is_email( $email ) ) {
			return $err( 'ایمیل واردشده معتبر نیست.' );
		}
		if ( higer_contact_len( $message ) < 10 ) {
			return $err( 'متن پیام باید حداقل ۱۰ حرف باشد.' );
		}
		if ( ! in_array( $topic, (array) $f['topics'], true ) ) {
			$topic = ! empty( $f['topics'] ) ? $f['topics'][0] : 'سایر موارد';
		}

		/* ذخیره در پیشخوان */
		$post_id = 0;
		if ( ! empty( $f['store_messages'] ) && post_type_exists( 'higer_message' ) ) {
			$content = $message . "\n\n— شماره تماس: " . $phone . ( $email ? "\n— ایمیل: " . $email : '' ) . ( $page ? "\n— صفحه: " . $page : '' ) . "\n— IP: " . $ip;
			$post_id = wp_insert_post( array(
				'post_type'    => 'higer_message',
				'post_status'  => 'private',
				'post_title'   => $name . ' — ' . $topic,
				'post_content' => $content,
				'meta_input'   => array(
					'_hc_phone' => $phone,
					'_hc_email' => $email,
					'_hc_topic' => $topic,
					'_hc_page'  => $page,
					'_hc_ip'    => $ip,
				),
			), true );
			if ( is_wp_error( $post_id ) ) {
				$post_id = 0;
			}
		}

		/* ارسال ایمیل */
		$to      = ! empty( $f['recipient'] ) ? $f['recipient'] : get_option( 'admin_email' );
		$subject = trim( $f['subject_prefix'] . ' پیام جدید از ' . $name . ' — ' . $topic );
		$rows    = array(
			'نام'      => $name,
			'تلفن'     => $phone,
			'ایمیل'    => $email ? $email : '—',
			'موضوع'    => $topic,
			'صفحه'     => $page ? $page : '—',
			'زمان ثبت' => date_i18n( 'Y/m/d H:i' ),
		);
		$body = '<div dir="rtl" style="font-family:Tahoma,Arial,sans-serif;background:#f3efe3;padding:24px"><div style="max-width:640px;margin:auto;background:#fff;border:1px solid #e3ddcd;border-radius:16px;overflow:hidden">';
		$body .= '<div style="background:#10243e;color:#f3d98b;padding:18px 22px;font-weight:bold;font-size:16px">پیام جدید از فرم تماس تشک هیگر</div>';
		$body .= '<table style="width:100%;border-collapse:collapse;font-size:14px;color:#10243e">';
		foreach ( $rows as $label => $value ) {
			$body .= '<tr><td style="padding:10px 22px;border-bottom:1px solid #f3efe3;color:#2b4e77;width:110px;white-space:nowrap">' . esc_html( $label ) . '</td><td style="padding:10px 22px;border-bottom:1px solid #f3efe3;font-weight:bold">' . esc_html( $value ) . '</td></tr>';
		}
		$body .= '</table><div style="padding:18px 22px;line-height:2;font-size:14px;color:#10243e">' . nl2br( esc_html( $message ) ) . '</div>';
		if ( $post_id ) {
			$body .= '<div style="padding:0 22px 18px;font-size:12px"><a href="' . esc_url( admin_url( 'post.php?post=' . $post_id . '&action=edit' ) ) . '" style="color:#c8892a">مشاهده در پیشخوان وردپرس</a></div>';
		}
		$body .= '</div></div>';

		$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		if ( $email ) {
			$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
		}
		foreach ( (array) $f['cc'] as $cc ) {
			if ( is_email( $cc ) ) {
				$headers[] = 'Cc: ' . $cc;
			}
		}
		$sent = wp_mail( $to, $subject, $body, $headers );

		if ( ! $sent && ! $post_id ) {
			return $err( 'ارسال پیام با خطا مواجه شد. لطفاً از طریق تماس تلفنی با ما در ارتباط باشید.' );
		}

		$log[] = $now;
		set_transient( $key, $log, HOUR_IN_SECONDS );

		return $ok( $f['success'] );
	}
}

/* پاسخ AJAX */
if ( ! function_exists( 'higer_contact_ajax' ) ) {
	function higer_contact_ajax() {
		$result = higer_contact_process( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification
		wp_send_json( $result );
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'wp_ajax_higer_contact', 'higer_contact_ajax' );
		add_action( 'wp_ajax_nopriv_higer_contact', 'higer_contact_ajax' );
	}
}

/* حالت بدون جاوااسکریپت: ارسال کلاسیک به admin-post.php و بازگشت با پیام */
if ( ! function_exists( 'higer_contact_post_fallback' ) ) {
	function higer_contact_post_fallback() {
		$result = higer_contact_process( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification
		$back   = isset( $_POST['_hc_back'] ) ? esc_url_raw( wp_unslash( $_POST['_hc_back'] ) ) : home_url( '/' ); // phpcs:ignore
		$back   = wp_validate_redirect( $back, home_url( '/' ) );
		/* فقط کد وضعیت به نشانی صفحه اضافه می‌شود (نه متن پیام) تا کسی نتواند با یک لینک دست‌ساز متن دلخواه نمایش دهد */
		$url    = add_query_arg( array( 'hc' => $result['ok'] ? 'ok' : 'err' ), $back ) . '#hc-form';
		wp_safe_redirect( $url );
		exit;
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'admin_post_higer_contact', 'higer_contact_post_fallback' );
		add_action( 'admin_post_nopriv_higer_contact', 'higer_contact_post_fallback' );
	}
}

/* ============================================================
   بخش ۳ — استایل و اسکریپت (فقط یک‌بار در هر صفحه چاپ می‌شود)
   ============================================================ */

if ( ! function_exists( 'higer_contact_assets' ) ) {
	function higer_contact_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		$ajax    = function_exists( 'admin_url' ) ? admin_url( 'admin-ajax.php' ) : '/wp-admin/admin-ajax.php';
		ob_start();
		?>
<style id="higer-contact-styles">
/* ================== هیگر — استایل صفحه تماس با ما (نسخه بدون بیلد) ================== */
.higer-contact{
  --hc-navy-950:#070f1d;--hc-navy-900:#10243e;--hc-navy-800:#183250;--hc-navy-700:#1f3e63;--hc-navy-600:#2b4e77;
  --hc-gold-600:#c8892a;--hc-gold-500:#d9a13b;--hc-gold-400:#e7b95c;--hc-gold-300:#f3d98b;--hc-gold-200:#f8ead0;
  --hc-cream:#faf7ef;--hc-paper:#f3efe3;--hc-line:#e3ddcd;--hc-ok:#047857;--hc-bad:#b91c1c;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--hc-navy-900);background:var(--hc-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-contact *,.higer-contact *::before,.higer-contact *::after{box-sizing:border-box}
.higer-contact :is(h1,h2,h3,h4,p,ul,ol,figure){margin:0;padding:0;border:0}
.higer-contact :is(h1,h2,h3,h4){font-family:inherit;color:inherit;letter-spacing:normal;text-transform:none;font-weight:900;line-height:1.5}
.higer-contact :is(ul,ol){list-style:none}
.higer-contact a{color:inherit;text-decoration:none;background:none}
.higer-contact button{font:inherit;color:inherit;background:none;border:0;border-radius:0;padding:0;margin:0;cursor:pointer;text-transform:none;letter-spacing:normal;box-shadow:none;line-height:inherit;min-height:0;width:auto;white-space:normal;text-align:inherit}
.higer-contact img{display:block;max-width:100%;height:auto;border:0}
.higer-contact svg{flex:none;display:block}
.higer-contact .hc-i{display:inline-block;vertical-align:middle}
.higer-contact [hidden]{display:none!important}
.higer-contact [id]{scroll-margin-top:110px}
.higer-contact :focus-visible{outline:3px solid var(--hc-gold-600);outline-offset:3px}
.higer-contact .hc-wrap{width:100%;max-width:1280px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-contact .hc-wrap{padding-inline:24px}}
.higer-contact .hc-sec{padding-block:56px}
@media(min-width:1024px){.higer-contact .hc-sec{padding-block:72px}}

/* ---------- نشان‌ها و دکمه‌های مشترک ---------- */
.higer-contact .hc-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.78);color:var(--hc-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800;line-height:1.6}
.higer-contact .hc-kicker.is-dark{background:rgba(7,15,29,.55);color:var(--hc-gold-300);border-color:rgba(217,161,59,.4)}
.higer-contact .hc-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-contact .hc-h2{margin-top:12px;font-size:24px}
@media(min-width:640px){.higer-contact .hc-h2{font-size:30px}}
.higer-contact .hc-lead{margin-top:10px;font-size:13px;line-height:2;color:var(--hc-navy-700);max-width:42rem}
.higer-contact :is(a,button).hc-btn-gold{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:8px;overflow:hidden;border:0;border-radius:9999px;padding:13px 24px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hc-navy-900);font-size:13px;font-weight:900;line-height:1.4;white-space:nowrap;box-shadow:0 10px 24px rgba(217,161,59,.35),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .2s,filter .2s}
.higer-contact :is(a,button).hc-btn-gold:is(:hover,:focus){background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hc-navy-900);transform:translateY(-2px);filter:brightness(1.04)}
.higer-contact :is(a,button).hc-btn-gold::after{content:"";position:absolute;top:-60%;inset-inline-start:-80%;width:55%;height:220%;background:linear-gradient(105deg,transparent,rgba(255,255,255,.75),transparent);transform:skewX(-18deg);animation:hc-shimmer 3.6s ease-in-out infinite;pointer-events:none}
@keyframes hc-shimmer{0%,55%{inset-inline-start:-90%}100%{inset-inline-start:140%}}
.higer-contact button.hc-btn-gold:disabled{cursor:wait;opacity:.6;transform:none;filter:none}
.higer-contact a.hc-btn-outline{display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(243,217,139,.42);color:var(--hc-gold-300);border-radius:9999px;padding:12px 22px;font-size:13px;font-weight:800;transition:all .25s}
.higer-contact a.hc-btn-outline:hover{background:rgba(243,217,139,.1);border-color:rgba(243,217,139,.8);color:var(--hc-gold-200)}
.higer-contact a.hc-btn-dark{display:inline-flex;align-items:center;gap:8px;border-radius:9999px;background:var(--hc-navy-900);padding:10px 16px;font-size:12px;font-weight:800;color:var(--hc-gold-300);transition:background .25s}
.higer-contact a.hc-btn-dark:hover{background:var(--hc-navy-800);color:var(--hc-gold-300)}

/* ---------- سربرگ ---------- */
.higer-contact .hc-hero{position:relative;overflow:hidden;padding-block:0 92px;background:radial-gradient(960px 440px at 85% -10%,rgba(217,161,59,.18),transparent 60%),radial-gradient(800px 420px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 48%,#16304f 100%);color:var(--hc-cream)}
.higer-contact .hc-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-contact .hc-hero>*{position:relative}
.higer-contact .hc-crumbs{margin-bottom:32px;border-bottom:1px solid rgba(243,217,139,.16)}
.higer-contact .hc-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:rgba(250,247,239,.74)}
.higer-contact .hc-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-contact .hc-crumbs li+li::before{content:"‹";color:var(--hc-gold-400);font-weight:900}
.higer-contact .hc-crumbs a:hover{color:var(--hc-gold-300)}
.higer-contact .hc-crumbs [aria-current]{color:#fff;font-weight:900}
.higer-contact .hc-hero-grid{display:grid;gap:28px;align-items:center}
@media(min-width:1024px){.higer-contact .hc-hero-grid{grid-template-columns:minmax(0,1.5fr) minmax(0,380px)}}
.higer-contact .hc-hero-title{margin-top:14px;font-size:30px;line-height:1.4;color:#fff}
@media(min-width:640px){.higer-contact .hc-hero-title{font-size:40px}}
.higer-contact .hc-hero-sub{margin-top:10px;max-width:640px;font-size:13.5px;line-height:2;color:rgba(248,234,208,.85)}
.higer-contact .hc-hero-actions{display:flex;flex-wrap:wrap;align-items:center;gap:12px;margin-top:22px}
.higer-contact .hc-status-card{padding:22px;border-radius:24px;border:1px solid rgba(243,217,139,.28);background:radial-gradient(320px 160px at 90% 0%,rgba(217,161,59,.22),transparent 70%),rgba(7,15,29,.5);box-shadow:0 24px 54px rgba(4,10,22,.42),inset 0 1px 0 rgba(255,255,255,.08)}
.higer-contact .hc-status-head{display:flex;align-items:center;gap:10px;font-size:12px;font-weight:800;color:var(--hc-gold-300)}
.higer-contact .hc-pulse{position:relative;width:10px;height:10px;border-radius:50%;background:#34d399;animation:hc-pulse 1.8s ease-out infinite}
@keyframes hc-pulse{0%{box-shadow:0 0 0 0 rgba(52,211,153,.55)}100%{box-shadow:0 0 0 12px rgba(52,211,153,0)}}
.higer-contact .hc-status-card a.hc-status-phone{display:block;margin-top:12px;font-size:28px;font-weight:900;color:#fff;direction:ltr;unicode-bidi:embed;text-align:right;letter-spacing:.02em;transition:color .2s}
.higer-contact .hc-status-card a.hc-status-phone:hover{color:var(--hc-gold-300)}
.higer-contact .hc-status-card small{display:block;margin-top:4px;font-size:12px;color:rgba(250,247,239,.7)}
.higer-contact .hc-status-rows{margin-top:16px;padding-top:14px;border-top:1px solid rgba(243,217,139,.16);display:grid;gap:9px;font-size:12px;color:rgba(250,247,239,.85)}
.higer-contact .hc-status-rows span{display:flex;align-items:flex-start;gap:8px;line-height:1.8}
.higer-contact .hc-status-rows .hc-i{color:var(--hc-gold-400);margin-top:3px}

/* ---------- کانال‌های ارتباطی ---------- */
.higer-contact .hc-channels{position:relative;z-index:2;margin-top:-56px;padding-block:0}
.higer-contact .hc-channel-grid{display:grid;gap:14px;grid-template-columns:1fr}
@media(min-width:640px){.higer-contact .hc-channel-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(min-width:1024px){.higer-contact .hc-channel-grid{grid-template-columns:repeat(4,minmax(0,1fr))}}
.higer-contact .hc-channel{display:flex;flex-direction:column;gap:12px;padding:20px;border:1px solid var(--hc-line);border-radius:22px;background:#fff;box-shadow:0 18px 44px rgba(16,36,62,.1);transition:transform .22s,border-color .22s}
.higer-contact .hc-channel:hover{transform:translateY(-3px);border-color:var(--hc-gold-500)}
.higer-contact .hc-channel-ico{display:grid;place-items:center;width:44px;height:44px;border-radius:14px;background:var(--hc-navy-900);color:var(--hc-gold-400)}
.higer-contact .hc-channel-label{font-size:11px;font-weight:800;color:var(--hc-navy-600)}
.higer-contact .hc-channel-value{font-size:15px;font-weight:900;color:var(--hc-navy-900);line-height:1.7;word-break:break-word}
.higer-contact .hc-channel-value.is-ltr{direction:ltr;unicode-bidi:embed;text-align:right}
.higer-contact .hc-channel-actions{display:flex;flex-wrap:wrap;align-items:center;gap:8px;margin-top:auto;padding-top:12px;border-top:1px solid var(--hc-line)}
.higer-contact .hc-channel-actions a.hc-btn-dark{padding:8px 14px}
.higer-contact button.hc-copy{display:inline-flex;align-items:center;gap:5px;border:1px solid var(--hc-line);border-radius:9999px;padding:7px 12px;font-size:11px;font-weight:800;color:var(--hc-navy-700);background:var(--hc-cream);transition:border-color .2s,color .2s}
.higer-contact button.hc-copy:hover{border-color:var(--hc-gold-500);color:var(--hc-gold-600);background:var(--hc-cream)}
.higer-contact button.hc-copy .hc-copy-done{display:none}
.higer-contact button.hc-copy.is-done{border-color:var(--hc-ok);color:var(--hc-ok)}
.higer-contact button.hc-copy.is-done .hc-copy-idle{display:none}
.higer-contact button.hc-copy.is-done .hc-copy-done{display:inline-flex;align-items:center;gap:5px}

/* ---------- فرم و ستون کناری ---------- */
.higer-contact .hc-main-grid{display:grid;gap:24px;align-items:start}
@media(min-width:1024px){.higer-contact .hc-main-grid{grid-template-columns:minmax(0,1.25fr) minmax(0,.85fr)}}
.higer-contact .hc-form-card{position:relative;padding:26px;border:1px solid var(--hc-line);border-radius:26px;background:#fff;box-shadow:0 24px 60px rgba(16,36,62,.08)}
@media(min-width:640px){.higer-contact .hc-form-card{padding:32px}}
.higer-contact .hc-form{position:relative;margin-top:22px}
.higer-contact .hc-form-grid{display:grid;gap:14px}
@media(min-width:640px){.higer-contact .hc-form-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
.higer-contact .hc-field{display:flex;flex-direction:column;gap:6px;margin:0}
.higer-contact .hc-field-full{grid-column:1/-1}
.higer-contact .hc-field>span{font-size:12px;font-weight:800;color:var(--hc-navy-800)}
.higer-contact .hc-field>span i{font-style:normal;color:var(--hc-gold-600)}
.higer-contact .hc-field :is(input,select,textarea){width:100%;margin:0;border:1.5px solid var(--hc-line);border-radius:14px;padding:12px 14px;background:#fffdf6;color:var(--hc-navy-900);font:inherit;font-size:13.5px;font-weight:700;line-height:1.6;box-shadow:none;outline:none;appearance:none;-webkit-appearance:none;transition:border-color .2s,box-shadow .2s}
.higer-contact .hc-field :is(input,select,textarea):focus{border-color:var(--hc-gold-500);box-shadow:0 0 0 4px rgba(217,161,59,.15)}
.higer-contact .hc-field :is(input,textarea)::placeholder{color:rgba(43,78,119,.45);font-weight:500}
.higer-contact .hc-field select{background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%232b4e77' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='m6 9 6 6 6-6'/></svg>");background-repeat:no-repeat;background-position:left 14px center;padding-left:38px;cursor:pointer}
.higer-contact .hc-field textarea{min-height:140px;resize:vertical}
.higer-contact .hc-field input[dir="ltr"]{text-align:left}
.higer-contact .hc-hp{position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;opacity:0}
.higer-contact .hc-form-foot{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px;margin-top:18px;padding-top:18px;border-top:1px solid var(--hc-line)}
.higer-contact .hc-form-note{display:flex;align-items:center;gap:6px;font-size:11.5px;color:var(--hc-navy-600)}
.higer-contact .hc-form-note .hc-i{color:var(--hc-gold-600)}
.higer-contact .hc-notice{margin-top:16px;padding:13px 16px;border-radius:14px;border:1px solid;font-size:13px;font-weight:700;line-height:1.9}
.higer-contact .hc-notice[data-ok="1"]{background:#ecfdf5;border-color:#6ee7b7;color:#065f46}
.higer-contact .hc-notice[data-ok="0"]{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
.higer-contact .hc-side{display:grid;gap:16px;align-content:start}
.higer-contact .hc-map-card{overflow:hidden;border:1px solid var(--hc-line);border-radius:24px;background:#fff;box-shadow:0 18px 44px rgba(16,36,62,.08)}
.higer-contact .hc-map-frame{position:relative;aspect-ratio:4/3;background:var(--hc-navy-900)}
.higer-contact .hc-map-frame iframe{position:absolute;inset:0;z-index:1;width:100%;height:100%;border:0}
.higer-contact .hc-map-ph{position:absolute;inset:0;z-index:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:20px;text-align:center;color:var(--hc-cream);background:radial-gradient(420px 220px at 80% 0%,rgba(217,161,59,.22),transparent 70%),linear-gradient(160deg,#0b1a30,#16304f)}
.higer-contact .hc-map-ph::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.06) 1px,transparent 1px);background-size:36px 36px}
.higer-contact .hc-map-ph>*{position:relative}
.higer-contact .hc-map-pin{display:grid;place-items:center;width:58px;height:58px;border-radius:50%;border:1px solid rgba(243,217,139,.4);background:rgba(217,161,59,.16);color:var(--hc-gold-300)}
.higer-contact .hc-map-ph b{font-size:15px;font-weight:900}
.higer-contact .hc-map-ph small{font-size:11.5px;line-height:1.8;color:rgba(250,247,239,.72);max-width:300px}
.higer-contact .hc-map-foot{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;padding:14px 16px;font-size:12px;font-weight:700;color:var(--hc-navy-700)}
.higer-contact .hc-map-loc{display:inline-flex;align-items:center;gap:6px}
.higer-contact .hc-map-loc .hc-i{color:var(--hc-gold-600)}
.higer-contact .hc-map-actions{display:flex;flex-wrap:wrap;align-items:center;gap:7px}
.higer-contact a.hc-map-alt{display:inline-flex;align-items:center;gap:5px;padding:9px 13px;border-radius:9999px;border:1px solid var(--hc-line);background:var(--hc-cream);color:var(--hc-navy-800);font-size:11.5px;font-weight:800;transition:border-color .2s,color .2s}
.higer-contact a.hc-map-alt:hover{border-color:var(--hc-gold-500);color:var(--hc-gold-600)}
.higer-contact .hc-info-card{padding:22px;border-radius:24px;background:var(--hc-navy-900);color:var(--hc-cream);border:1px solid rgba(243,217,139,.18);box-shadow:0 18px 44px rgba(7,15,29,.3)}
.higer-contact .hc-info-card h3{display:flex;align-items:center;gap:8px;font-size:14px;color:var(--hc-gold-300)}
.higer-contact .hc-hours{margin-top:14px;display:grid;gap:8px}
.higer-contact .hc-hours li{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:10px 12px;border-radius:12px;background:rgba(255,255,255,.05);font-size:12.5px;font-weight:700}
.higer-contact .hc-hours li b{color:var(--hc-gold-200);font-weight:900}
.higer-contact .hc-hours li.is-off{opacity:.6}
/* متن طلایی روی زمینه روشن (background-clip باید بعد از background دوباره تعریف شود) */
.higer-contact .hc-gold-text.on-light{background:linear-gradient(175deg,#d9a13b 0%,#c8892a 50%,#a86f1c 100%);-webkit-background-clip:text;background-clip:text}

/* ---------- پیام‌رسان‌ها و شبکه‌های اجتماعی ---------- */
.higer-contact .hc-messengers{position:relative;overflow:hidden;display:grid;gap:18px;align-items:center;margin-top:14px;padding:22px;border:1px solid rgba(243,217,139,.26);border-radius:24px;background:radial-gradient(520px 220px at 90% 0%,rgba(217,161,59,.2),transparent 70%),linear-gradient(160deg,#0b1a30 0%,#10243e 55%,#16304f 100%);color:var(--hc-cream);box-shadow:0 18px 44px rgba(7,15,29,.22)}
@media(min-width:1200px){.higer-contact .hc-messengers{grid-template-columns:minmax(0,.8fr) minmax(0,1.7fr);gap:24px;padding:26px 28px}}
.higer-contact .hc-messengers h2{margin-top:10px;font-size:20px;color:#fff}
.higer-contact .hc-messengers p{margin-top:6px;font-size:12.5px;line-height:1.95;color:rgba(248,234,208,.8)}
.higer-contact .hc-messenger-list{display:grid;gap:10px}
@media(min-width:860px){.higer-contact .hc-messenger-list{grid-template-columns:repeat(3,minmax(0,1fr))}}
.higer-contact a.hc-messenger{display:flex;align-items:center;gap:12px;padding:14px;border:1px solid rgba(243,217,139,.2);border-radius:18px;background:rgba(7,15,29,.45);color:var(--hc-cream);transition:border-color .22s,background .22s,transform .22s}
.higer-contact a.hc-messenger:hover{border-color:rgba(231,185,92,.7);background:rgba(217,161,59,.12);color:var(--hc-cream);transform:translateY(-2px)}
.higer-contact .hc-messenger-ico{display:grid;place-items:center;flex:none;width:44px;height:44px;border-radius:50%;border:1px solid rgba(243,217,139,.35);background:rgba(217,161,59,.14);color:var(--hc-gold-300)}
.higer-contact .hc-messenger-text{display:block;flex:1;min-width:0}
.higer-contact .hc-messenger-text b{display:block;font-size:13.5px;font-weight:900;color:#fff}
.higer-contact .hc-messenger-text small{display:block;margin-top:2px;overflow:hidden;font-size:12px;font-weight:700;color:var(--hc-gold-200);direction:ltr;unicode-bidi:embed;text-align:right;text-overflow:ellipsis;white-space:nowrap}
.higer-contact .hc-messenger-arrow{flex:none;color:var(--hc-gold-400);transition:transform .22s}
.higer-contact a.hc-messenger:hover .hc-messenger-arrow{transform:translateX(-3px)}
.higer-contact .hc-quick{display:grid;gap:10px}
.higer-contact a.hc-quick-item{display:flex;align-items:center;gap:12px;padding:14px 16px;border:1px solid var(--hc-line);border-radius:18px;background:#fff;transition:border-color .2s,transform .2s}
.higer-contact a.hc-quick-item:hover{border-color:var(--hc-gold-500);transform:translateY(-2px)}
.higer-contact .hc-quick-ico{display:grid;place-items:center;flex:none;width:40px;height:40px;border-radius:12px;background:var(--hc-paper);color:var(--hc-gold-600)}
.higer-contact .hc-quick-item b{display:block;font-size:13px;font-weight:900}
.higer-contact .hc-quick-item small{display:block;font-size:11px;color:var(--hc-navy-600)}
.higer-contact .hc-quick-arrow{margin-inline-start:auto;color:var(--hc-gold-500)}

/* ---------- سؤالات پرتکرار ---------- */
.higer-contact .hc-faq{background:var(--hc-paper)}
.higer-contact .hc-faq-inner{max-width:56rem;margin-inline:auto}
.higer-contact .hc-faq-head{text-align:center;margin-bottom:18px}
.higer-contact details.hc-acc{margin-top:10px;overflow:hidden;border:1px solid var(--hc-line);border-radius:16px;background:#fff}
.higer-contact details.hc-acc[open]{border-color:rgba(217,161,59,.6);box-shadow:0 14px 30px rgba(16,36,62,.08)}
.higer-contact .hc-acc summary{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:16px 18px;cursor:pointer;list-style:none;font-size:14px;font-weight:800;color:var(--hc-navy-900)}
.higer-contact .hc-acc summary::-webkit-details-marker{display:none}
.higer-contact .hc-acc summary::after{content:"+";display:grid;place-items:center;flex:none;width:26px;height:26px;border-radius:50%;background:var(--hc-paper);color:var(--hc-gold-600);font-weight:900;transition:background .25s}
.higer-contact details.hc-acc[open] summary::after{content:"−";background:var(--hc-navy-900);color:var(--hc-gold-300)}
.higer-contact .hc-acc-body{padding:0 18px 16px;font-size:13px;line-height:2;color:var(--hc-navy-700)}
@media(prefers-reduced-motion:reduce){.higer-contact *,.higer-contact *::before,.higer-contact *::after{animation:none!important;transition:none!important}}
</style>

<script id="higer-contact-script">
(function () {
  if (window.__higerContactInit) return;
  window.__higerContactInit = true;

  var AJAX_URL = <?php echo wp_json_encode( $ajax ); ?>;
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
    if (root.getAttribute('data-hc-mounted')) return;
    root.setAttribute('data-hc-mounted', '1');

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

    /* دکمه‌های کپی شماره / ایمیل / آدرس */
    Array.prototype.forEach.call(root.querySelectorAll('[data-hc-copy]'), function (btn) {
      btn.addEventListener('click', function () {
        var value = btn.getAttribute('data-hc-copy') || '';
        var done = function () {
          btn.classList.add('is-done');
          window.setTimeout(function () { btn.classList.remove('is-done'); }, 1600);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(value).then(done, done);
        } else {
          var ta = document.createElement('textarea');
          ta.value = value;
          document.body.appendChild(ta);
          ta.select();
          try { document.execCommand('copy'); } catch (e) {}
          document.body.removeChild(ta);
          done();
        }
      });
    });

    /* فرم تماس با AJAX */
    var form = root.querySelector('[data-hc-form]');
    if (!form) return;
    var notice = form.querySelector('[data-hc-notice]');
    var btn = form.querySelector('[data-hc-submit]');
    var btnText = form.querySelector('[data-hc-submit-text]');

    function showNotice(ok, msg) {
      if (!notice) return;
      notice.hidden = false;
      notice.setAttribute('data-ok', ok ? '1' : '0');
      notice.textContent = msg;
      if (notice.scrollIntoView) notice.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }

    function field(name) { return form.querySelector('[name="' + name + '"]'); }

    form.addEventListener('submit', function (e) {
      if (!window.fetch || !window.FormData) return; /* حالت کلاسیک بدون جاوااسکریپت */
      e.preventDefault();

      var name = field('hc_name'), phone = field('hc_phone'), email = field('hc_email'), message = field('hc_message');
      var digits = (phone ? phone.value : '').replace(/[۰-۹]/g, function (d) { return String('۰۱۲۳۴۵۶۷۸۹'.indexOf(d)); }).replace(/[^0-9+]/g, '');
      if (!name || name.value.trim().length < 2) { showNotice(false, 'لطفاً نام خود را وارد کنید.'); if (name) name.focus(); return; }
      if (digits.length < 8) { showNotice(false, 'لطفاً یک شماره تماس معتبر وارد کنید.'); if (phone) phone.focus(); return; }
      if (email && email.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) { showNotice(false, 'ایمیل واردشده معتبر نیست.'); email.focus(); return; }
      if (!message || message.value.trim().length < 10) { showNotice(false, 'متن پیام باید حداقل ۱۰ حرف باشد.'); if (message) message.focus(); return; }

      var oldText = btnText ? btnText.textContent : '';
      if (btn) btn.disabled = true;
      if (btnText) btnText.textContent = 'در حال ارسال...';
      if (notice) notice.hidden = true;

      var data = new FormData(form);
      data.set('action', 'higer_contact');

      var finish = function () {
        if (btn) btn.disabled = false;
        if (btnText) btnText.textContent = oldText;
      };

      fetch(AJAX_URL, { method: 'POST', body: data, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          finish();
          showNotice(!!(res && res.ok), (res && res.message) ? res.message : 'پاسخی از سرور دریافت نشد.');
          if (res && res.ok) {
            form.reset();
            var ts = field('hc_ts');
            if (ts) ts.value = String(Math.floor(Date.now() / 1000));
          }
        })
        .catch(function () {
          finish();
          showNotice(false, 'ارتباط با سرور برقرار نشد. لطفاً دوباره تلاش کنید یا تلفنی با ما در ارتباط باشید.');
        });
    });
  }

  function init() {
    addFonts();
    Array.prototype.forEach.call(document.querySelectorAll('.higer-contact'), mount);
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
   بخش ۴ — خروجی HTML و ثبت شورت‌کد [higer_contact]
   ============================================================ */

if ( ! function_exists( 'higer_contact_render' ) ) {
	function higer_contact_render( $atts = array() ) {
		$atts = function_exists( 'shortcode_atts' )
			? shortcode_atts( array( 'fullwidth' => 'yes', 'form' => 'yes', 'map' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_contact' )
			: array( 'fullwidth' => 'yes', 'form' => 'yes', 'map' => 'yes' );

		$cfg   = higer_contact_config();
		$store = $cfg['store'];
		$hero  = $cfg['hero'];
		$beh   = $cfg['behavior'];
		$form  = $cfg['form'];
		$fa    = 'higer_contact_fa';

		$show_form = 'no' !== strtolower( (string) $atts['form'] ) && ! empty( $beh['show_form'] );
		$show_map  = 'no' !== strtolower( (string) $atts['map'] ) && ! empty( $beh['show_map'] );
		$fullwidth = 'no' !== strtolower( (string) $atts['fullwidth'] );
		$uid       = 'hc-' . substr( md5( uniqid( 'higer-contact', true ) ), 0, 6 );
		$home      = function_exists( 'home_url' ) ? home_url( '/' ) : '/';

		if ( ! empty( $beh['suppress_footer_cta'] ) ) {
			$GLOBALS['higer_suppress_footer_cta'] = true;
		}

		$map_q      = ! empty( $store['map_query'] ) ? $store['map_query'] : $store['address'];
		$map_zoom   = ! empty( $store['map_zoom'] ) ? max( 10, min( 20, (int) $store['map_zoom'] ) ) : 16;
		$map_embed  = ! empty( $store['map_embed'] )
			? $store['map_embed']
			: ( $show_map && '' !== trim( $map_q ) ? 'https://maps.google.com/maps?q=' . rawurlencode( $map_q ) . '&t=m&z=' . $map_zoom . '&output=embed&iwloc=near&hl=fa' : '' );
		$map_url    = ! empty( $store['map_url'] )
			? $store['map_url']
			: 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $map_q );
		$has_coords = isset( $store['lat'], $store['lng'] ) && is_numeric( $store['lat'] ) && is_numeric( $store['lng'] );
		$neshan_url = ! empty( $store['neshan_url'] )
			? $store['neshan_url']
			: ( $has_coords ? 'https://nshn.ir/?lat=' . rawurlencode( (string) $store['lat'] ) . '&lng=' . rawurlencode( (string) $store['lng'] ) : '' );

		$phone_e   = str_replace( 'tel:', '', $store['tel'] );
		$land_e    = str_replace( 'tel:', '', $store['land_tel'] );
		$permalink = ( function_exists( 'get_the_ID' ) && get_the_ID() ) ? get_permalink( get_the_ID() ) : '';
		$page_url  = $permalink ? $permalink : $home;
		$back_url  = $permalink ? $permalink : esc_url_raw( home_url( remove_query_arg( array( 'hc', 'hcm' ) ) ) );

		/* پیام نتیجه در حالت بدون جاوااسکریپت */
		$notice    = '';
		$notice_ok = false;
		if ( isset( $_GET['hc'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			$notice_ok = ( 'ok' === sanitize_key( wp_unslash( $_GET['hc'] ) ) ); // phpcs:ignore
			/* متن پیام هرگز از نشانی صفحه خوانده نمی‌شود؛ فقط کد وضعیت ok/err */
			$notice    = $notice_ok ? $form['success'] : 'ارسال پیام انجام نشد. لطفاً فیلدهای ستاره‌دار را کامل کنید و چند لحظه بعد دوباره تلاش کنید، یا تلفنی با ما در ارتباط باشید.';
		}

		$channels = array(
			array( 'icon' => 'smartphone', 'label' => 'تلفن همراه و مشاوره فروش', 'value' => $store['phone'],    'href' => $store['tel'],              'action' => 'تماس',        'copy' => $phone_e,         'ltr' => true ),
			array( 'icon' => 'phone',      'label' => 'تلفن ثابت دفتر مرکزی',     'value' => $store['landline'], 'href' => $store['land_tel'],         'action' => 'تماس',        'copy' => $land_e,          'ltr' => true ),
			array( 'icon' => 'mail',       'label' => 'پست الکترونیک',           'value' => $store['email'],    'href' => 'mailto:' . $store['email'], 'action' => 'ارسال ایمیل', 'copy' => $store['email'],  'ltr' => true ),
			array( 'icon' => 'pin',        'label' => 'شوروم و دفتر مرکزی',       'value' => $store['address'],  'href' => $map_url,                   'action' => 'مسیریابی',    'copy' => $store['address'], 'ltr' => false, 'external' => true ),
		);

		$active_socials = array();
		foreach ( (array) $cfg['socials'] as $soc ) {
			if ( ! empty( $soc['url'] ) ) {
				$active_socials[] = $soc;
			}
		}

		ob_start();
		echo higer_contact_assets(); // phpcs:ignore
		?>
<div class="higer-contact" id="<?php echo esc_attr( $uid ); ?>" dir="rtl" lang="fa" data-hc-fw="<?php echo $fullwidth ? 'yes' : 'no'; ?>">

	<!-- ===== سربرگ ===== -->
	<section class="hc-hero">
		<div class="hc-wrap">
			<nav class="hc-crumbs" aria-label="مسیر صفحه">
				<ol>
					<li><a href="<?php echo esc_url( $home ); ?>">خانه</a></li>
					<li aria-current="page">تماس با ما</li>
				</ol>
			</nav>
			<div class="hc-hero-grid">
				<div>
					<span class="hc-kicker is-dark"><?php echo higer_contact_icon( 'chat', 13 ); // phpcs:ignore ?> <?php echo esc_html( $hero['kicker'] ); ?></span>
					<h1 class="hc-hero-title"><?php echo esc_html( $hero['title_a'] ); ?><span class="hc-gold-text"><?php echo esc_html( $hero['title_b'] ); ?></span></h1>
					<p class="hc-hero-sub"><?php echo esc_html( $hero['subtitle'] ); ?></p>
					<div class="hc-hero-actions">
						<a class="hc-btn-gold" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_contact_icon( 'phone', 16 ); // phpcs:ignore ?> تماس با مشاور فروش — <?php echo esc_html( $store['phone'] ); ?></a>
						<?php if ( $show_form ) : ?>
							<a class="hc-btn-outline" href="#hc-form"><?php echo higer_contact_icon( 'send', 15 ); // phpcs:ignore ?> ارسال پیام آنلاین</a>
						<?php endif; ?>
					</div>
				</div>
				<aside class="hc-status-card" aria-label="وضعیت پاسخگویی">
					<div class="hc-status-head"><span class="hc-pulse" aria-hidden="true"></span><?php echo esc_html( $hero['status'] ); ?></div>
					<a class="hc-status-phone" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo esc_html( $store['phone'] ); ?></a>
					<small><?php echo esc_html( ! empty( $hero['phone_note'] ) ? $hero['phone_note'] : 'خط مستقیم مشاوره و سفارش' ); ?></small>
					<div class="hc-status-rows">
						<span><?php echo higer_contact_icon( 'clock', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['hours'] ); ?></span>
						<span><?php echo higer_contact_icon( 'phone', 14 ); // phpcs:ignore ?> تلفن ثابت: <a href="<?php echo esc_url( $store['land_tel'] ); ?>" style="direction:ltr;unicode-bidi:embed"><?php echo esc_html( $store['landline'] ); ?></a></span>
						<span><?php echo higer_contact_icon( 'pin', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['city'] ); ?>، <?php echo esc_html( $store['province'] ); ?> — شوروم و دفتر مرکزی</span>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<!-- ===== کانال‌های ارتباطی ===== -->
	<section class="hc-sec hc-channels" aria-label="راه‌های ارتباطی">
		<div class="hc-wrap">
			<div class="hc-channel-grid">
				<?php foreach ( $channels as $ch ) : ?>
					<article class="hc-channel">
						<span class="hc-channel-ico"><?php echo higer_contact_icon( $ch['icon'], 20 ); // phpcs:ignore ?></span>
						<div>
							<div class="hc-channel-label"><?php echo esc_html( $ch['label'] ); ?></div>
							<div class="hc-channel-value<?php echo ! empty( $ch['ltr'] ) ? ' is-ltr' : ''; ?>"><?php echo esc_html( $ch['value'] ); ?></div>
						</div>
						<div class="hc-channel-actions">
							<a class="hc-btn-dark" href="<?php echo esc_url( $ch['href'] ); ?>"<?php echo ! empty( $ch['external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo higer_contact_icon( ! empty( $ch['external'] ) ? 'navigate' : 'arrow-l', 13 ); // phpcs:ignore ?> <?php echo esc_html( $ch['action'] ); ?></a>
							<button type="button" class="hc-copy" data-hc-copy="<?php echo esc_attr( $ch['copy'] ); ?>" aria-label="کپی">
								<span class="hc-copy-idle"><?php echo higer_contact_icon( 'copy', 12 ); // phpcs:ignore ?> کپی</span>
								<span class="hc-copy-done"><?php echo higer_contact_icon( 'check', 12 ); // phpcs:ignore ?> کپی شد</span>
							</button>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<?php if ( ! empty( $active_socials ) ) : ?>
			<!-- پیام‌رسان‌ها و شبکه‌های اجتماعی -->
			<div class="hc-messengers" id="hc-social">
				<div>
					<span class="hc-kicker is-dark"><?php echo higer_contact_icon( 'chat', 12 ); // phpcs:ignore ?> پیام‌رسان‌ها و شبکه‌های اجتماعی</span>
					<h2><?php echo esc_html( ! empty( $cfg['socials_title'] ) ? $cfg['socials_title'] : 'گفتگوی آنلاین با هیگر' ); ?></h2>
					<?php if ( ! empty( $cfg['socials_intro'] ) ) : ?><p><?php echo esc_html( $cfg['socials_intro'] ); ?></p><?php endif; ?>
				</div>
				<div class="hc-messenger-list">
					<?php foreach ( $active_socials as $soc ) : ?>
						<a class="hc-messenger" href="<?php echo esc_url( $soc['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $soc['label'] . ' ' . $store['name'] ); ?>">
							<span class="hc-messenger-ico"><?php echo higer_contact_icon( $soc['key'], 20 ); // phpcs:ignore ?></span>
							<span class="hc-messenger-text">
								<b><?php echo esc_html( ! empty( $soc['cta'] ) ? $soc['cta'] : $soc['label'] ); ?></b>
								<?php if ( ! empty( $soc['handle'] ) ) : ?><small><?php echo esc_html( $soc['handle'] ); ?></small><?php endif; ?>
							</span>
							<?php echo str_replace( 'class="hc-i"', 'class="hc-i hc-messenger-arrow"', higer_contact_icon( 'arrow-l', 15 ) ); // phpcs:ignore ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- ===== فرم پیام + شوروم ===== -->
	<section class="hc-sec" id="hc-form">
		<div class="hc-wrap hc-main-grid">
			<?php if ( $show_form ) : ?>
			<div class="hc-form-card">
				<span class="hc-kicker"><?php echo higer_contact_icon( 'send', 12 ); // phpcs:ignore ?> فرم ارتباط با هیگر</span>
				<h2 class="hc-h2"><?php echo esc_html( $form['title'] ); ?></h2>
				<p class="hc-lead"><?php echo esc_html( $form['intro'] ); ?></p>

				<form class="hc-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-hc-form novalidate>
					<input type="hidden" name="action" value="higer_contact">
					<input type="hidden" name="_hc_nonce" value="<?php echo esc_attr( wp_create_nonce( 'higer_contact' ) ); ?>">
					<input type="hidden" name="_hc_back" value="<?php echo esc_url( $back_url ); ?>">
					<input type="hidden" name="hc_ts" value="<?php echo (int) time(); ?>">
					<div class="hc-hp" aria-hidden="true"><label>وب‌سایت <input type="text" name="hc_website" tabindex="-1" autocomplete="off"></label></div>

					<div class="hc-form-grid">
						<label class="hc-field">
							<span>نام و نام خانوادگی <i>*</i></span>
							<input type="text" name="hc_name" required minlength="2" autocomplete="name" placeholder="مثلاً: علی رضایی">
						</label>
						<label class="hc-field">
							<span>شماره تماس <i>*</i></span>
							<input type="tel" name="hc_phone" required inputmode="tel" dir="ltr" autocomplete="tel" placeholder="0911 000 0000">
						</label>
						<label class="hc-field">
							<span>ایمیل (اختیاری)</span>
							<input type="email" name="hc_email" dir="ltr" autocomplete="email" placeholder="you@example.com">
						</label>
						<label class="hc-field">
							<span>موضوع پیام</span>
							<select name="hc_topic">
								<?php foreach ( (array) $form['topics'] as $topic ) : ?>
									<option value="<?php echo esc_attr( $topic ); ?>"><?php echo esc_html( $topic ); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
						<label class="hc-field hc-field-full">
							<span>متن پیام <i>*</i></span>
							<textarea name="hc_message" rows="5" required minlength="10" placeholder="مثلاً: برای تخت ۱۶۰×۲۰۰ و وزن حدود ۸۰ کیلوگرم، کدام مدل با سفتی متوسط را پیشنهاد می‌کنید؟"></textarea>
						</label>
					</div>

					<div class="hc-form-foot">
						<p class="hc-form-note"><?php echo higer_contact_icon( 'lock', 13 ); // phpcs:ignore ?> اطلاعات شما فقط برای پاسخ‌گویی استفاده می‌شود.</p>
						<button type="submit" class="hc-btn-gold" data-hc-submit><span data-hc-submit-text>ارسال پیام</span> <?php echo higer_contact_icon( 'send', 15 ); // phpcs:ignore ?></button>
					</div>

					<div class="hc-notice" data-hc-notice role="status" aria-live="polite" data-ok="<?php echo $notice_ok ? '1' : '0'; ?>"<?php echo '' === $notice ? ' hidden' : ''; ?>><?php echo esc_html( $notice ); ?></div>
				</form>
			</div>
			<?php else : ?>
			<div class="hc-form-card">
				<span class="hc-kicker"><?php echo higer_contact_icon( 'chat', 12 ); // phpcs:ignore ?> ارتباط مستقیم</span>
				<h2 class="hc-h2">در ساعات کاری پاسخگوی شما هستیم</h2>
				<p class="hc-lead">برای مشاوره انتخاب تشک یا پیگیری سفارش، با شماره‌های بالا تماس بگیرید یا به شوروم بابل مراجعه کنید.</p>
			</div>
			<?php endif; ?>

			<aside class="hc-side">
				<div class="hc-map-card">
					<div class="hc-map-frame">
						<!-- پس‌زمینه پشتیبان هنگام بارگذاری نقشه یا در حالت بدون iframe -->
						<div class="hc-map-ph">
							<span class="hc-map-pin"><?php echo higer_contact_icon( 'pin', 26 ); // phpcs:ignore ?></span>
							<b>شوروم و دفتر مرکزی هیگر</b>
							<small><?php echo esc_html( $store['address'] ); ?></small>
						</div>
						<?php if ( $show_map && '' !== $map_embed ) : ?>
							<iframe src="<?php echo esc_url( $map_embed ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?php echo esc_attr( 'نقشه گوگل شوروم ' . $store['name'] . ' — ' . $map_q ); ?>" allowfullscreen></iframe>
						<?php endif; ?>
					</div>
					<div class="hc-map-foot">
						<span class="hc-map-loc"><?php echo higer_contact_icon( 'pin', 14 ); // phpcs:ignore ?> <?php echo esc_html( $store['city'] ); ?>، <?php echo esc_html( $store['province'] ); ?></span>
						<div class="hc-map-actions">
							<a class="hc-btn-dark" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_contact_icon( 'navigate', 13 ); // phpcs:ignore ?> گوگل‌مپ</a>
							<?php if ( '' !== $neshan_url ) : ?>
								<a class="hc-map-alt" href="<?php echo esc_url( $neshan_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_contact_icon( 'pin', 12 ); // phpcs:ignore ?> نشان</a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="hc-info-card">
					<h3><?php echo higer_contact_icon( 'clock', 16 ); // phpcs:ignore ?> ساعات کاری شوروم و پاسخگویی</h3>
					<ul class="hc-hours">
						<?php foreach ( (array) $store['week'] as $row ) : ?>
							<li<?php echo ! empty( $row['off'] ) ? ' class="is-off"' : ''; ?>><span><?php echo esc_html( $row['day'] ); ?></span><b><?php echo esc_html( $row['hours'] ); ?></b></li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="hc-quick">
					<?php foreach ( (array) $cfg['quick'] as $q ) : ?>
						<a class="hc-quick-item" href="<?php echo esc_url( $q['url'] ); ?>">
							<span class="hc-quick-ico"><?php echo higer_contact_icon( $q['icon'], 18 ); // phpcs:ignore ?></span>
							<span><b><?php echo esc_html( $q['title'] ); ?></b><small><?php echo esc_html( $q['sub'] ); ?></small></span>
							<?php echo str_replace( 'class="hc-i"', 'class="hc-i hc-quick-arrow"', higer_contact_icon( 'arrow-l', 16 ) ); // phpcs:ignore ?>
						</a>
					<?php endforeach; ?>
				</div>
			</aside>
		</div>
	</section>

	<!-- ===== سؤالات پرتکرار ===== -->
	<?php if ( ! empty( $cfg['faqs'] ) ) : ?>
	<section class="hc-sec hc-faq" id="hc-faq">
		<div class="hc-wrap hc-faq-inner">
			<div class="hc-faq-head">
				<span class="hc-kicker">؟ پیش از تماس</span>
				<h2 class="hc-h2">سؤالات <span class="hc-gold-text on-light">پرتکرار</span></h2>
			</div>
			<?php $i = 0; foreach ( (array) $cfg['faqs'] as $faq ) : $i++; ?>
				<details class="hc-acc"<?php echo 1 === $i ? ' open' : ''; ?>>
					<summary><?php echo esc_html( $faq['q'] ); ?></summary>
					<div class="hc-acc-body"><?php echo esc_html( $faq['a'] ); ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( ! empty( $beh['structured_data'] ) ) :
		$schema = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				array( '@type' => 'ContactPage', 'name' => 'تماس با ' . $store['name'], 'url' => $page_url ),
				array(
					'@type'     => 'Store',
					'name'      => $store['name'],
					'url'       => $home,
					'telephone' => $phone_e,
					'email'     => $store['email'],
					'address'   => array( '@type' => 'PostalAddress', 'streetAddress' => $store['address'], 'addressLocality' => $store['city'], 'addressRegion' => $store['province'], 'addressCountry' => 'IR' ),
					'openingHoursSpecification' => array( array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ), 'opens' => $store['opens'], 'closes' => $store['closes'] ) ),
				),
			),
		);
		/* صفحه‌های رسمی برند در شبکه‌های اجتماعی (فقط مواردی که profile = true دارند) */
		$same_as = array();
		foreach ( $active_socials as $soc ) {
			if ( ! empty( $soc['profile'] ) ) {
				$same_as[] = $soc['url'];
			}
		}
		if ( $same_as ) {
			$schema['@graph'][1]['sameAs'] = $same_as;
		}
		$schema['@graph'][1]['hasMap'] = $map_url;
		if ( $has_coords ) {
			$schema['@graph'][1]['geo'] = array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => (float) $store['lat'],
				'longitude' => (float) $store['lng'],
			);
		}
		?>
		<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>
	<?php endif; ?>
</div>
		<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_contact' ) ) {
	add_shortcode( 'higer_contact', 'higer_contact_render' );
}

/* حالت بدون المنتور: جایگزینی خودکار محتوای برگه تماس با ما */
if ( ! function_exists( 'higer_contact_auto_content' ) ) {
	function higer_contact_auto_content( $content ) {
		$cfg = higer_contact_config();
		if ( empty( $cfg['behavior']['auto_content'] ) || ! function_exists( 'is_page' ) || ! is_page( $cfg['behavior']['page_slug'] ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}
		return higer_contact_render();
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'the_content', 'higer_contact_auto_content', 20 );
	}
}

