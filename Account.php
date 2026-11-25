<?php
/**
 * Higer Account — صفحه «حساب کاربری» تشک هیگر | نسخه بدون بیلد (v1.1)
 * =====================================================================
 * اسنیپت PHP مستقل برای افزونه WPCode، طراحی‌شده دقیقاً هم‌خانواده با
 * Home Page.php، Shop Page.php، Single Product Page.php، Cart Page.php و هدر/فوتر هیگر.
 *
 * ─── نصب در WPCode (۲ دقیقه) ───
 *  ۱. Code Snippets > Add Snippet > Add Your Custom Code > PHP Snippet
 *  ۲. کل همین فایل را Paste کنید.
 *  ۳. Insert Method: Auto Insert  —  Location: Run Everywhere
 *  ۴. Save و Activate
 *
 * ─── نمایش در برگه «حساب کاربری» (/my-account/) ───
 *  با المنتور: وارد ویرایش برگه «حساب کاربری» شوید، ویجت قدیمی My Account را
 *  حذف کنید و یک ویجت Shortcode در یک کانتینر تمام‌عرض بگذارید:
 *      [higer_account]
 *  بدون المنتور: در بخش تنظیمات پایین 'auto_content' را true کنید تا محتوای
 *  برگه حساب کاربری ووکامرس به‌طور خودکار جایگزین شود.
 *
 * ─── شورت‌کدها ───
 *  [higer_account]                 نمایش کامل حساب کاربری (ورود/عضویت یا پنل مشتری)
 *  [higer_account fullwidth="no"]  بدون کشیدگی تمام‌عرض
 *
 * ─── امکانات یکپارچه ───
 *  • حالت مهمان: کارت دو تبه «ورود به حساب» و «ثبت‌نام» با دکمه نمایش رمز عبور + مزایای عضویت و پیگیری سفارش
 *  • ثبت‌نام با شماره همراه (بدون نیاز به ایمیل): شماره موبایل به‌عنوان نام کاربری ثبت می‌شود و همیشه
 *    در فیلد استاندارد billing_phone ووکامرس ذخیره می‌گردد (منحصربه‌فرد برای هر حساب).
 *  • ثبت خودکار شماره همراه و نام ثبت‌نامی در پروفایل کاربری (در ویرایشگر پیشخوان وردپرس هم دیده می‌شود)
 *  • پشتیبانی ۱۰۰٪ بومی از بازیابی و تغییر رمز عبور (/my-account/lost-password/)
 *  • پیشخوان اختصاصی مشتری: آمار سفارش‌ها، آخرین سفارش‌ها با وضعیت رنگی، خلاصه آدرس‌ها و میان‌برها
 *  • سازگار کامل با تمام زیرصفحات ووکامرس فارسی (سفارش‌ها، مشاهده فاکتور، استان/شهر آدرس‌ها، جزئیات حساب و خروج)
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   بخش ۱ — تنظیمات (فقط اینجا را ویرایش کنید)
   ============================================================ */

if ( ! function_exists( 'higer_account_config' ) ) :
function higer_account_config() {
	$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
	$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';
	$cart = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : rtrim( $home, '/' ) . '/my-cart/';

	return array(
		/* --- فروشگاه و پشتیبانی مشتریان --- */
		'store' => array(
			'name'         => 'تشک هیگر',
			'phone'        => '۰۹۱۱۱۱۸۶۴۸۵',
			'tel'          => 'tel:+989111186485',
			'whatsapp_url' => 'https://wa.me/989111186485?text=' . rawurlencode( 'سلام، درباره سفارش یا حساب کاربری‌ام در سایت تشک هیگر سؤال داشتم.' ),
			'telegram_url' => 'https://t.me/+989111186485',
			'hours'        => 'همه‌روزه به‌جز روزهای تعطیل، ساعت ۹ الی ۲۱',
		),

		/* --- لینک‌های کلیدی --- */
		'urls' => array(
			'home'    => $home,
			'shop'    => $shop,
			'cart'    => $cart,
			'finder'  => rtrim( $home, '/' ) . '/#hg-finder',
			'contact' => rtrim( $home, '/' ) . '/contact-us/',
		),

		/* --- رفتار اسنیپت --- */
		'behavior' => array(
			'auto_content'        => false,        // true = جایگزینی خودکار محتوای برگه حساب کاربری بدون المنتور
			'page_slug'           => 'my-account', // نامک برگه حساب کاربری
			'recent_orders_count' => 5,            // تعداد آخرین سفارش‌ها در پیشخوان مشتری
			'hide_downloads_item' => false,        // true = پنهان کردن آیتم «دانلودها» از منو (چون محصولات تشک فیزیکی‌اند)
			'suppress_footer_cta' => true,         // پنهان‌کردن بنر مشاوره Footer.php در این صفحه
		),

		/* --- ثبت‌نام با شماره همراه ---
		   ایمیل اختیاری می‌شود؛ شماره موبایل شناسه اصلی حساب (نام کاربری) است.
		   توجه: در ووکامرس > تنظیمات > حساب‌ها و حریم خصوصی، گزینه «در هنگام پرداخت اجازه ثبت‌نام بدهید»
		   باید روشن باشد تا تب ثبت‌نام نمایش داده شود. */
		'registration' => array(
			'phone_is_username' => true, // true = شماره همراه به‌عنوان نام کاربری ثبت می‌شود
			'email_required'    => false, // false = ایمیل اختیاری؛ true = ایمیل هم اجباری می‌شود
			'min_length'        => 10,
			'max_length'        => 15,
			'note'              => 'برای ورود بعدی به هیگر، همین شماره همراه را وارد کنید؛ اطلاعیه‌های سفارش نیز با پیامک یا تماس برای شما ارسال می‌شود.',
		),

		/* --- متن‌های حالت ورود / ثبت‌نام (کاربر مهمان) --- */
		'guest' => array(
			'kicker'       => 'پنل مشتریان تشک هیگر',
			'title_a'      => 'ورود و ',
			'title_b'      => 'حساب کاربری',
			'subtitle'     => 'برای مشاهده وضعیت سفارش‌ها، مدیریت آدرس ارسال و دسترسی به فاکتور و سوابق گارانتی وارد حساب خود شوید. با شماره همراه خود ثبت‌نام کنید و بدون ایمیل عضو شوید.',
			'side_kicker'  => 'مزایای حساب کاربری',
			'side_title'   => 'همه سفارش‌ها و سوابق خرید شما در یکجا',
			'benefits'     => array(
				array( 'icon' => 'package', 'title' => 'پیگیری لحظه‌ای سفارش‌ها',   'sub' => 'مشاهده وضعیت پردازش، ارسال و جزئیات کامل فاکتور' ),
				array( 'icon' => 'shield',  'title' => 'ثبت تاریخ شروع گارانتی',    'sub' => 'دسترسی همیشگی به شماره و تاریخ ثبت فاکتور رسمی' ),
				array( 'icon' => 'pin',     'title' => 'ذخیره آدرس و خرید سریع‌تر', 'sub' => 'ثبت پیش‌فرض استان، شهر و نشانی تحویل برای سفارش‌های بعدی' ),
				array( 'icon' => 'chat',    'title' => 'ارتباط مستقیم با پشتیبانی', 'sub' => 'هماهنگی سریع زمان ارسال از طریق تلفن یا واتساپ' ),
			),
			'track_note'   => 'اگر سفارش خود را تلفنی یا کارت‌به‌کارت ثبت کرده‌اید، از طریق واتساپ یا تماس مستقیم وضعیت ارسال را پیگیری کنید.',
		),

		/* --- متن‌های حالت واردشده (پنل مشتری) --- */
		'portal' => array(
			'kicker'   => 'پیشخوان مشتریان هیگر',
			'welcome'  => 'خوش آمدید، ',
			'subtitle' => 'از این بخش می‌توانید سفارش‌های خود را بررسی کنید، نشانی دریافت را ویرایش نمایید و اطلاعات حسابتان را مدیریت کنید.',
		),
	);
}
endif;

/* ============================================================
   بخش ۲ — توابع کمکی، آیکون‌ها و تشخیص زیرصفحه‌های ووکامرس
   ============================================================ */

if ( ! function_exists( 'higer_account_fa' ) ) {
	function higer_account_fa( $text ) {
		return strtr( (string) $text, array(
			'0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴',
			'5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹',
		) );
	}
}

if ( ! function_exists( 'higer_account_icon' ) ) {
	function higer_account_icon( $name, $size = 18 ) {
		$icons = array(
			'user'      => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
			'grid'      => '<rect width="7" height="7" x="3" y="3" rx="1.5"/><rect width="7" height="7" x="14" y="3" rx="1.5"/><rect width="7" height="7" x="14" y="14" rx="1.5"/><rect width="7" height="7" x="3" y="14" rx="1.5"/>',
			'package'   => '<path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>',
			'download'  => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/>',
			'pin'       => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
			'settings'  => '<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>',
			'logout'    => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/>',
			'lock'      => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
			'eye'       => '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>',
			'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/>',
			'bag'       => '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>',
			'moon'      => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
			'phone'     => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
			'whatsapp'  => '<path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
			'telegram'  => '<path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>',
			'chat'      => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
			'arrow-l'   => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'arrow-r'   => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
			'check'     => '<path d="M20 6 9 17l-5-5"/>',
			'clock'     => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
			'card'      => '<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>',
			'mail'      => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
			'edit'      => '<path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>',
		);
		$path = isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['grid'];
		return '<svg class="hka-i" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* آیکون مناسب برای هر آیتم منوی حساب کاربری ووکامرس */
if ( ! function_exists( 'higer_account_endpoint_icon' ) ) {
	function higer_account_endpoint_icon( $endpoint ) {
		$map = array(
			'dashboard'       => 'grid',
			'orders'          => 'package',
			'downloads'       => 'download',
			'edit-address'    => 'pin',
			'payment-methods' => 'card',
			'edit-account'    => 'settings',
			'customer-logout' => 'logout',
		);
		return isset( $map[ $endpoint ] ) ? $map[ $endpoint ] : 'user';
	}
}

/* تشخیص زیرصفحه (Endpoint) فعلی ووکامرس */
if ( ! function_exists( 'higer_account_current_endpoint' ) ) {
	function higer_account_current_endpoint() {
		global $wp;
		if ( ! function_exists( 'WC' ) || ! WC()->query ) {
			return 'dashboard';
		}
		foreach ( WC()->query->get_query_vars() as $key => $var ) {
			if ( isset( $wp->query_vars[ $var ] ) ) {
				return $key;
			}
		}
		return 'dashboard';
	}
}

/* رنگ‌بندی وضعیت سفارش ووکامرس */
if ( ! function_exists( 'higer_account_status_tone' ) ) {
	function higer_account_status_tone( $status ) {
		$status = str_replace( 'wc-', '', (string) $status );
		if ( in_array( $status, array( 'completed' ), true ) ) {
			return 'ok';
		}
		if ( in_array( $status, array( 'processing', 'on-hold', 'pending' ), true ) ) {
			return 'warn';
		}
		if ( in_array( $status, array( 'cancelled', 'failed', 'refunded' ), true ) ) {
			return 'bad';
		}
		return 'info';
	}
}

/* ============================================================
   بخش ۳ — ثبت‌نام با شماره همراه (شناسه اصلی حساب کاربری)
   ============================================================ */

/* استانداردسازی شماره همراه ایرانی به فرم ۹xxxxxxxxx (۹ رقم بدون صفر ابتدایی) */
if ( ! function_exists( 'higer_account_normalize_phone' ) ) {
	function higer_account_normalize_phone( $raw ) {
		$digits = preg_replace( '/\D+/', '', higer_account_en_digits( (string) $raw ) );
		if ( '' === $digits ) {
			return '';
		}
		/* حذف پیش‌شماره‌های ۰۰۹۸ و ۹۸ و صفر ابتدایی */
		$digits = preg_replace( '/^(?:0098|98|0)/', '', $digits );
		/* اگر کاربر شماره بین‌المللی دیگر وارد کرده باشد، همان را پذیرفتن */
		return $digits;
	}
}

/* یافتن حساب کاربری ثبت‌شده با یک شماره همراه */
if ( ! function_exists( 'higer_account_find_user_by_phone' ) ) {
	function higer_account_find_user_by_phone( $phone ) {
		if ( '' === $phone ) {
			return null;
		}
		$meta = get_users( array(
			'meta_key'   => 'billing_phone',
			'meta_value' => $phone,
			'number'     => 1,
		) );
		if ( ! empty( $meta ) ) {
			return $meta[0];
		}
		/* سازگاری با حساب‌هایی که شماره را با صفر یا ۹۸ ثبت کرده‌اند */
		$alts = array( '0' . $phone, '98' . $phone, '+98' . $phone );
		foreach ( $alts as $alt ) {
			$meta = get_users( array(
				'meta_key'   => 'billing_phone',
				'meta_value' => $alt,
				'number'     => 1,
			) );
			if ( ! empty( $meta ) ) {
				return $meta[0];
			}
		}
		return null;
	}
}

/* اعتبارسنجی فرم ثبت‌نام: شماره همراه الزامی، منحصربه‌فرد و معتبر */
if ( ! function_exists( 'higer_account_validate_registration' ) ) {
	function higer_account_validate_registration( $username, $email, $errors ) {
		$cfg = higer_account_config();
		$reg = $cfg['registration'];

		$raw_phone = isset( $_POST['hka_mobile'] ) ? wp_unslash( $_POST['hka_mobile'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
		$phone     = higer_account_normalize_phone( $raw_phone );
		$raw_email = isset( $_POST['hka_email'] ) ? sanitize_email( wp_unslash( $_POST['hka_email'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification

		/* ۱) شماره همراه الزامی و معتبر */
		if ( '' === $phone ) {
			$errors->add( 'hka_phone_empty', 'لطفاً شماره همراه خود را وارد کنید.' );
		} else {
			$len = strlen( $phone );
			if ( $len < (int) $reg['min_length'] || $len > (int) $reg['max_length'] ) {
				$errors->add( 'hka_phone_length', 'شماره همراه واردشده معتبر نیست. مثال صحیح: ۰۹۱۱۱۱۸۶۴۸۵' );
			} elseif ( (int) $reg['phone_is_username'] && preg_match( '/^9\d{9}$/', $phone ) ) {
				/* بررسی یکتا بودن شماره همراه در میان همه حساب‌ها */
				if ( higer_account_find_user_by_phone( $phone ) ) {
					$errors->add( 'hka_phone_exists', 'این شماره همراه قبلاً در هیگر ثبت شده است. به همین شماره وارد شوید یا رمز عبور را بازیابی کنید.' );
				}
			}
		}

		/* ۲) ایمیل: اختیاری (بسته به تنظیمات) اما در صورت وارد شدن باید معتبر باشد */
		if ( '' !== $raw_email ) {
			if ( ! is_email( $raw_email ) ) {
				$errors->add( 'hka_email_invalid', 'نشانی ایمیل واردشده معتبر نیست.' );
			} elseif ( email_exists( $raw_email ) ) {
				$errors->add( 'hka_email_exists', 'این نشانی ایمیل قبلاً در هیگر ثبت شده است.' );
			}
		} elseif ( ! empty( $reg['email_required'] ) ) {
			$errors->add( 'hka_email_empty', 'لطفاً نشانی ایمیل خود را وارد کنید.' );
		}

		/* ۳) اگر ووکامرس نام کاربری دلخواه می‌خواهد، آن را از شماره همراه می‌سازیم */
		if ( $errors->get_error_codes() ) {
			return $errors;
		}
		if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) && '' === trim( (string) $username ) && (int) $reg['phone_is_username'] && '' !== $phone ) {
			$_POST['username'] = $phone; // phpcs:ignore WordPress.Security.NonceVerification
			$_POST['billing_phone'] = $phone; // phpcs:ignore WordPress.Security.NonceVerification
		}
		return $errors;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'woocommerce_process_registration_errors', 'higer_account_validate_registration', 10, 4 );
	}
}

/* ساختن نام کاربری از شماره همراه در مرحله ایجاد حساب مشتری جدید */
if ( ! function_exists( 'higer_account_new_customer_data' ) ) {
	function higer_account_new_customer_data( $data ) {
		$cfg   = higer_account_config();
		$phone = higer_account_normalize_phone( isset( $_POST['hka_mobile'] ) ? wp_unslash( $_POST['hka_mobile'] ) : '' ); // phpcs:ignore WordPress.Security.NonceVerification

		if ( '' === $phone ) {
			return $data;
		}

		/* نام کاربری = شماره همراه (منحصربه‌فرد و بدون کاراکتر فارسی) */
		if ( ! empty( $cfg['registration']['phone_is_username'] ) ) {
			$username = $phone;
			$attempt  = 0;
			while ( username_exists( $username ) && $attempt < 20 ) {
				$attempt++;
				$username = $phone . $attempt;
			}
			$data['user_login'] = $username;

			/* نام نمایشی شماره همراه در لیست کاربران پیشخوان */
			$data['display_name'] = higer_account_fa( $phone );
		}

		/* ایمیل: اگر کاربر وارد نکرده باشد، یک ایمیل رزرو درونی ساخته می‌شود (چون وردپرس آن را اجباری می‌داند) */
		$raw_email = isset( $_POST['hka_email'] ) ? sanitize_email( wp_unslash( $_POST['hka_email'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
		if ( is_email( $raw_email ) ) {
			$data['user_email'] = $raw_email;
		} elseif ( empty( $data['user_email'] ) || ! is_email( $data['user_email'] ) ) {
			$data['user_email'] = 'customer-' . $phone . '@guests.higermattress.ir';
		}

		return $data;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'woocommerce_new_customer_data', 'higer_account_new_customer_data', 20 );
	}
}

/* ثبت شماره همراه، ایمیل اختیاری و نام کاربر در متا (بلافاصله پس از ساخت حساب) */
if ( ! function_exists( 'higer_account_save_registration_fields' ) ) {
	function higer_account_save_registration_fields( $customer_id ) {
		$phone = higer_account_normalize_phone( isset( $_POST['hka_mobile'] ) ? wp_unslash( $_POST['hka_mobile'] ) : '' ); // phpcs:ignore WordPress.Security.NonceVerification
		$email = isset( $_POST['hka_email'] ) ? sanitize_email( wp_unslash( $_POST['hka_email'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
		$first = isset( $_POST['hka_first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['hka_first_name'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
		$last  = isset( $_POST['hka_last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['hka_last_name'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification

		if ( '' !== $phone ) {
			update_user_meta( $customer_id, 'billing_phone', $phone );
			update_user_meta( $customer_id, 'shipping_phone', $phone );
			update_user_meta( $customer_id, 'hka_primary_phone', $phone );
		}
		if ( is_email( $email ) ) {
			update_user_meta( $customer_id, 'billing_email', $email );
			update_user_meta( $customer_id, 'shipping_email', $email );
		}
		if ( '' !== $first ) {
			update_user_meta( $customer_id, 'billing_first_name', $first );
			update_user_meta( $customer_id, 'shipping_first_name', $first );
			wp_update_user( array( 'ID' => $customer_id, 'display_name' => trim( $first . ' ' . $last ) ) );
		}
		if ( '' !== $last ) {
			update_user_meta( $customer_id, 'billing_last_name', $last );
			update_user_meta( $customer_id, 'shipping_last_name', $last );
		}
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'woocommerce_created_customer', 'higer_account_save_registration_fields', 20 );
	}
}

/* ورود با شماره همراه: اگر کاربر در فیلد ورود فقط شماره همراه بنویسد، به نام کاربری واقعی تبدیل می‌شود */
if ( ! function_exists( 'higer_account_login_by_phone' ) ) {
	function higer_account_login_by_phone( $username ) {
		if ( is_email( $username ) || '' === trim( (string) $username ) ) {
			return $username;
		}
		$digits = preg_replace( '/\D+/', '', higer_account_en_digits( (string) $username ) );
		if ( strlen( $digits ) < 8 ) {
			return $username;
		}
		$phone    = higer_account_normalize_phone( $digits );
		$attempts = array(
			$phone,
			'0' . $phone,
			'98' . $phone,
			'+98' . $phone,
			'customer-' . $phone,
		);
		foreach ( $attempts as $candidate ) {
			$by_login = username_exists( $candidate );
			if ( $by_login ) {
				return is_object( $by_login ) ? $by_login->user_login : (string) $by_login;
			}
		}
		$found = higer_account_find_user_by_phone( $phone );
		if ( $found ) {
			return $found->user_login;
		}
		return $username;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'pre_option_woocommerce_registration_generate_username', function () { return 'no'; }, 5 );
		add_filter( 'authenticate', 'higer_account_login_by_phone', 20, 1 );
		add_filter( 'woocommerce_process_login_errors', function ( $validation_error, $username, $password ) {
			/* پیام خطای واضح‌تر اگر شماره همراه ثبت نشده باشد */
			if ( is_wp_error( $validation_error ) && ! $validation_error->get_error_codes() ) {
				$phone = higer_account_normalize_phone( $username );
				if ( '' !== $phone && ! username_exists( $phone ) && ! higer_account_find_user_by_phone( $phone ) ) {
					$validation_error->add( 'hka_no_account', 'حسابی با این شماره همراه در هیگر یافت نشد. ابتدا از تب «ثبت‌نام سریع» عضو شوید.' );
				}
			}
			return $validation_error;
		}, 20, 3 );
	}
}

/* پنهان‌کردن اختیاری تب دانلودها از منوی ووکامرس */
if ( ! function_exists( 'higer_account_filter_menu_items' ) ) {
	function higer_account_filter_menu_items( $items ) {
		$cfg = higer_account_config();
		if ( ! empty( $cfg['behavior']['hide_downloads_item'] ) ) {
			unset( $items['downloads'] );
		}
		return $items;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'woocommerce_account_menu_items', 'higer_account_filter_menu_items', 20 );
	}
}

/* ============================================================
   بخش ۳ — استایل و اسکریپت یکپارچه (فقط یک‌بار چاپ می‌شود)
   ============================================================ */

if ( ! function_exists( 'higer_account_assets' ) ) {
	function higer_account_assets() {
		static $printed = false;
		if ( $printed ) {
			return '';
		}
		$printed = true;
		ob_start();
		?>
<style id="higer-account-styles">
/* ================== هیگر — استایل صفحه حساب کاربری (نسخه بدون بیلد) ================== */
.higer-account{
  --hka-navy-950:#070f1d;--hka-navy-900:#10243e;--hka-navy-800:#183250;--hka-navy-700:#1f3e63;--hka-navy-600:#2b4e77;
  --hka-gold-600:#c8892a;--hka-gold-500:#d9a13b;--hka-gold-400:#e7b95c;--hka-gold-300:#f3d98b;--hka-gold-200:#f8ead0;
  --hka-cream:#faf7ef;--hka-paper:#f3efe3;--hka-line:#e3ddcd;--hka-ok:#047857;--hka-bad:#b91c1c;
  display:block;font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;color:var(--hka-navy-900);background:var(--hka-cream);
  direction:rtl;text-align:right;font-size:16px;line-height:1.65;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
.higer-account *,.higer-account *::before,.higer-account *::after{box-sizing:border-box}
.higer-account :is(h1,h2,h3,h4,p,ul,ol,figure){margin:0;padding:0;border:0}
.higer-account :is(h1,h2,h3,h4){font-family:inherit;color:inherit;font-weight:900;line-height:1.5}
.higer-account :is(ul,ol){list-style:none}
.higer-account a{color:inherit;text-decoration:none!important;background:none}
.higer-account svg{flex:none;display:block}
.higer-account .hka-i{display:inline-block;vertical-align:middle}
.higer-account [hidden]{display:none!important}
.higer-account :focus-visible{outline:3px solid var(--hka-gold-600);outline-offset:3px}
.higer-account .hka-wrap{width:100%;max-width:1320px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-account .hka-wrap{padding-inline:24px}}

/* نشان‌ها و دکمه‌های مشترک */
.higer-account .hka-kicker{display:inline-flex;align-items:center;gap:6px;border:1px solid rgba(217,161,59,.5);background:rgba(255,255,255,.8);color:var(--hka-gold-600);border-radius:9999px;padding:5px 14px;font-size:11px;font-weight:800}
.higer-account .hka-kicker.is-dark{background:rgba(7,15,29,.55);color:var(--hka-gold-300);border-color:rgba(217,161,59,.4)}
.higer-account .hka-gold-text{background:linear-gradient(175deg,#f8ead0 8%,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c 100%);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-account :is(a,button).hka-btn-gold{position:relative;overflow:hidden;display:inline-flex;align-items:center;justify-content:center;gap:8px;border:0;border-radius:9999px;padding:13px 24px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hka-navy-900)!important;font:inherit;font-size:13.5px;font-weight:900;cursor:pointer;white-space:nowrap;box-shadow:0 12px 26px rgba(217,161,59,.34),inset 0 1px 0 rgba(255,255,255,.75);transition:transform .22s,filter .22s}
.higer-account :is(a,button).hka-btn-gold:hover{transform:translateY(-2px);filter:brightness(1.04)}
.higer-account :is(a,button).hka-btn-outline{display:inline-flex;align-items:center;justify-content:center;gap:7px;border:1px solid rgba(243,217,139,.4);background:rgba(7,15,29,.35);color:var(--hka-gold-200)!important;border-radius:9999px;padding:11px 20px;font:inherit;font-size:12.5px;font-weight:800;cursor:pointer;transition:all .2s}
.higer-account :is(a,button).hka-btn-outline:hover{border-color:rgba(243,217,139,.8);background:rgba(243,217,139,.1)}
.higer-account :is(a,button).hka-btn-dark{display:inline-flex;align-items:center;justify-content:center;gap:7px;border:0;border-radius:9999px;padding:10px 18px;background:var(--hka-navy-900);color:var(--hka-gold-300)!important;font:inherit;font-size:12px;font-weight:800;cursor:pointer;transition:background .2s}
.higer-account :is(a,button).hka-btn-dark:hover{background:var(--hka-navy-800)}

/* سربرگ سرمه‌ای */
.higer-account .hka-hero{position:relative;overflow:hidden;padding-block:0 40px;background:radial-gradient(960px 440px at 85% -10%,rgba(217,161,59,.18),transparent 60%),radial-gradient(800px 420px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30 0%,#10243e 48%,#16304f 100%);color:var(--hka-cream)}
.higer-account .hka-hero::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px;pointer-events:none}
.higer-account .hka-hero>*{position:relative}
.higer-account .hka-crumbs{margin-bottom:26px;border-bottom:1px solid rgba(243,217,139,.16)}
.higer-account .hka-crumbs ol{display:flex;flex-wrap:wrap;align-items:center;gap:6px;padding-block:12px;font-size:12px;font-weight:700;color:rgba(250,247,239,.72)}
.higer-account .hka-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-account .hka-crumbs li+li::before{content:"‹";color:var(--hka-gold-400);font-weight:900}
.higer-account .hka-crumbs a:hover{color:var(--hka-gold-300)}
.higer-account .hka-crumbs [aria-current]{color:#fff;font-weight:900}

.higer-account .hka-hero-user{display:flex;flex-direction:column;gap:20px}
@media(min-width:900px){.higer-account .hka-hero-user{flex-direction:row;align-items:center;justify-content:space-between}}
.higer-account .hka-user-id{display:flex;align-items:center;gap:16px}
.higer-account .hka-avatar{width:64px;height:64px;border-radius:20px;border:1.5px solid rgba(243,217,139,.45);background:radial-gradient(circle at 30% 25%,rgba(236,196,112,.28),rgba(7,15,29,.75));color:var(--hka-gold-300);display:grid;place-items:center;font-size:24px;font-weight:900;overflow:hidden;flex:none}
.higer-account .hka-avatar img{width:100%;height:100%;object-fit:cover}
.higer-account .hka-hero-title{margin-top:8px;font-size:26px;color:#fff}
@media(min-width:640px){.higer-account .hka-hero-title{font-size:34px}}
.higer-account .hka-hero-sub{margin-top:6px;max-width:580px;font-size:13px;line-height:1.95;color:rgba(248,234,208,.82)}
.higer-account .hka-user-meta{display:flex;flex-wrap:wrap;gap:8px;margin-top:8px}
.higer-account .hka-meta-pill{display:inline-flex;align-items:center;gap:6px;padding:4px 11px;border-radius:9999px;border:1px solid rgba(243,217,139,.24);background:rgba(7,15,29,.45);font-size:11.5px;font-weight:700;color:var(--hka-gold-200)}
.higer-account .hka-hero-btns{display:flex;flex-wrap:wrap;align-items:center;gap:10px}

/* بخش اصلی و پیام‌های ووکامرس */
.higer-account .hka-body{padding-block:36px 68px}
.higer-account .hka-notices :is(.woocommerce-message,.woocommerce-info,.woocommerce-error){display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin:0 0 18px;padding:13px 18px;border:1px solid var(--hka-line);border-radius:16px;background:#fff;font-size:13px;font-weight:700;list-style:none;box-shadow:0 10px 24px rgba(16,36,62,.05)}
.higer-account .hka-notices .woocommerce-error{border-color:rgba(185,28,28,.35);background:#fef2f2;color:#991b1b}
.higer-account .hka-notices .woocommerce-error li{list-style:none}

/* ================== حالت مهمان: ورود / ثبت‌نام ================== */
.higer-account .hka-auth-grid{display:grid;gap:24px;align-items:start}
@media(min-width:1024px){.higer-account .hka-auth-grid{grid-template-columns:minmax(0,1.15fr) minmax(0,.9fr);gap:28px}}
.higer-account .hka-auth-card{padding:26px;border:1px solid var(--hka-line);border-radius:28px;background:#fff;box-shadow:0 24px 60px rgba(16,36,62,.08)}
@media(min-width:640px){.higer-account .hka-auth-card{padding:34px}}
.higer-account .hka-auth-tabs{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:6px;padding:5px;border-radius:16px;background:var(--hka-paper);border:1px solid var(--hka-line);margin-bottom:24px}
.higer-account button.hka-auth-tab{padding:11px 14px;border:0;border-radius:12px;background:transparent;font:inherit;font-size:13.5px;font-weight:900;color:var(--hka-navy-700);cursor:pointer;transition:all .2s}
.higer-account button.hka-auth-tab[aria-selected="true"]{background:var(--hka-navy-900);color:var(--hka-gold-300);box-shadow:0 8px 20px rgba(16,36,62,.18)}

.higer-account .hka-field{display:flex;flex-direction:column;gap:6px;margin-bottom:15px}
.higer-account .hka-field label{font-size:12.5px;font-weight:800;color:var(--hka-navy-800)}
.higer-account .hka-field label i{font-style:normal;color:var(--hka-gold-600)}
.higer-account .hka-pass-wrap{position:relative;display:flex;align-items:center}
.higer-account .hka-field input,.higer-account .hka-native :is(input[type="text"],input[type="email"],input[type="tel"],input[type="password"],input[type="number"],select,textarea){width:100%;margin:0;border:1.5px solid var(--hka-line);border-radius:14px;padding:12px 14px;background:#fffdf6;color:var(--hka-navy-900);font:inherit;font-size:13.5px;font-weight:700;line-height:1.6;outline:none;box-shadow:none;transition:border-color .2s,box-shadow .2s}
.higer-account .hka-field input:focus,.higer-account .hka-native :is(input,select,textarea):focus{border-color:var(--hka-gold-500);box-shadow:0 0 0 4px rgba(217,161,59,.15)}
.higer-account .hka-field input[dir="ltr"]{text-align:left}
.higer-account .hka-field-row{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
@media(max-width:575px){.higer-account .hka-field-row{grid-template-columns:1fr}}
.higer-account .hka-field .hka-opt-tag{margin-inline-start:5px;padding:1px 7px;border-radius:999px;background:var(--hka-paper);border:1px solid var(--hka-line);font-size:10px;font-weight:800;color:var(--hka-navy-600);vertical-align:middle}
.higer-account .hka-phone-note{display:flex;align-items:flex-start;gap:8px;margin-bottom:16px;padding:11px 13px;border:1px solid rgba(217,161,59,.32);border-radius:14px;background:#fff9ec;font-size:11.5px;line-height:1.85;color:var(--hka-navy-800)}
.higer-account .hka-phone-note .hka-i{color:var(--hka-gold-600);margin-top:3px;flex:none}
.higer-account .hka-contact-card{display:grid;gap:12px;padding:18px;border:1px solid var(--hka-line);border-radius:20px;background:#fffdf8}
.higer-account .hka-contact-row{display:flex;align-items:center;gap:12px;padding:10px 12px;border:1px solid var(--hka-line);border-radius:14px;background:var(--hka-cream)}
.higer-account .hka-contact-ico{display:grid;place-items:center;width:36px;height:36px;border-radius:11px;background:var(--hka-navy-900);color:var(--hka-gold-400);flex:none}
.higer-account .hka-contact-row small{display:block;font-size:10.5px;font-weight:700;color:var(--hka-navy-600)}
.higer-account .hka-contact-row b{display:block;font-size:13.5px;font-weight:900;color:var(--hka-navy-900);direction:ltr;unicode-bidi:embed;text-align:right}
.higer-account .hka-contact-row a.hka-contact-edit{margin-inline-start:auto;display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:999px;border:1px solid var(--hka-line);font-size:11px;font-weight:800;color:var(--hka-gold-600);transition:border-color .2s,background .2s}
.higer-account .hka-contact-row a.hka-contact-edit:hover{border-color:var(--hka-gold-500);background:#fff}
.higer-account .hka-pass-wrap input{padding-left:44px}
.higer-account button.hka-eye-btn{position:absolute;left:8px;width:34px;height:34px;border:0;border-radius:10px;background:transparent;color:var(--hka-navy-600);display:grid;place-items:center;cursor:pointer}
.higer-account button.hka-eye-btn:hover{background:var(--hka-paper);color:var(--hka-navy-900)}
.higer-account .hka-auth-row{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin:4px 0 18px;font-size:12.5px}
.higer-account .hka-remember{display:inline-flex;align-items:center;gap:7px;font-weight:700;color:var(--hka-navy-700);cursor:pointer}
.higer-account .hka-remember input{width:17px;height:17px;accent-color:var(--hka-navy-900)}
.higer-account a.hka-lost-link{font-weight:800;color:var(--hka-gold-600)}
.higer-account a.hka-lost-link:hover{text-decoration:underline!important}
.higer-account .hka-auth-submit{width:100%;padding-block:14px}
.higer-account .hka-privacy-note,.higer-account .woocommerce-privacy-policy-text{margin-bottom:14px;font-size:11.5px;line-height:1.9;color:var(--hka-navy-600)}

/* کارت مزایای عضویت کنار فرم ورود */
.higer-account .hka-guest-side{padding:26px;border-radius:28px;border:1px solid rgba(243,217,139,.28);background:radial-gradient(420px 220px at 90% 0%,rgba(217,161,59,.18),transparent 70%),linear-gradient(165deg,#0b1a30 0%,#10243e 58%,#16304f 100%);color:var(--hka-cream);box-shadow:0 24px 58px rgba(7,15,29,.28)}
.higer-account .hka-guest-side h2{margin-top:12px;font-size:21px;color:#fff}
.higer-account .hka-benefit-list{display:grid;gap:12px;margin-top:20px}
.higer-account .hka-benefit{display:flex;align-items:flex-start;gap:12px;padding:13px 14px;border-radius:16px;border:1px solid rgba(243,217,139,.16);background:rgba(7,15,29,.42)}
.higer-account .hka-benefit-ico{display:grid;place-items:center;width:38px;height:38px;border-radius:12px;background:rgba(217,161,59,.16);color:var(--hka-gold-300);flex:none}
.higer-account .hka-benefit b{display:block;font-size:13px;font-weight:900;color:#fff}
.higer-account .hka-benefit small{display:block;margin-top:2px;font-size:11.5px;line-height:1.75;color:rgba(250,247,239,.72)}
.higer-account .hka-track-box{margin-top:18px;padding-top:16px;border-top:1px solid rgba(243,217,139,.16)}
.higer-account .hka-track-box p{font-size:12px;line-height:1.9;color:rgba(248,234,208,.8)}
.higer-account .hka-track-btns{display:flex;flex-wrap:wrap;gap:8px;margin-top:12px}

/* ================== حالت واردشده: پنل دو ستونه مشتری ================== */
.higer-account .hka-portal-grid{display:grid;gap:24px;align-items:start}
@media(min-width:1024px){.higer-account .hka-portal-grid{grid-template-columns:280px minmax(0,1fr);gap:28px}}
@media(min-width:1024px){.higer-account .hka-nav-col{position:sticky;top:98px}}
.higer-account .hka-nav-card{overflow:hidden;border:1px solid var(--hka-line);border-radius:24px;background:#fff;box-shadow:0 18px 44px rgba(16,36,62,.06)}
.higer-account .hka-menu{padding:10px;display:grid;gap:4px}
.higer-account .hka-menu a{display:flex;align-items:center;gap:10px;padding:11px 13px;border-radius:14px;font-size:13px;font-weight:800;color:var(--hka-navy-800);transition:all .18s}
.higer-account .hka-menu a .hka-i{color:var(--hka-gold-600)}
.higer-account .hka-menu a:hover{background:var(--hka-cream);color:var(--hka-navy-900)}
.higer-account .hka-menu a.is-active{background:var(--hka-navy-900);color:var(--hka-gold-300);box-shadow:0 10px 22px rgba(16,36,62,.18)}
.higer-account .hka-menu a.is-active .hka-i{color:var(--hka-gold-300)}
.higer-account .hka-menu a.is-logout{margin-top:4px;border-top:1px solid var(--hka-line);border-radius:0 0 12px 12px;padding-top:13px;color:var(--hka-bad)}
.higer-account .hka-menu a.is-logout .hka-i{color:var(--hka-bad)}
.higer-account .hka-menu-badge{margin-inline-start:auto;min-width:22px;height:22px;padding:0 6px;border-radius:9999px;background:var(--hka-paper);color:var(--hka-navy-900);font-size:11px;font-weight:900;display:inline-grid;place-items:center}
.higer-account .hka-menu a.is-active .hka-menu-badge{background:var(--hka-gold-500);color:var(--hka-navy-900)}

.higer-account .hka-support-mini{margin-top:14px;padding:18px;border-radius:22px;background:var(--hka-navy-900);color:var(--hka-cream);border:1px solid rgba(243,217,139,.2)}
.higer-account .hka-support-mini b{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--hka-gold-300)}
.higer-account .hka-support-mini p{margin-top:6px;font-size:11.5px;line-height:1.85;color:rgba(250,247,239,.74)}
.higer-account .hka-support-links{display:flex;flex-wrap:wrap;gap:7px;margin-top:12px}
.higer-account .hka-support-links a{display:inline-flex;align-items:center;gap:5px;padding:6px 11px;border-radius:999px;border:1px solid rgba(243,217,139,.26);font-size:11px;font-weight:800;color:var(--hka-gold-200)}
.higer-account .hka-support-links a:hover{border-color:var(--hka-gold-400);background:rgba(217,161,59,.14)}

/* کارت‌های پیشخوان مشتری */
.higer-account .hka-kpis{display:grid;gap:12px;grid-template-columns:repeat(2,minmax(0,1fr))}
@media(min-width:768px){.higer-account .hka-kpis{grid-template-columns:repeat(4,minmax(0,1fr))}}
.higer-account .hka-kpi{padding:18px;border:1px solid var(--hka-line);border-radius:20px;background:#fff;box-shadow:0 12px 30px rgba(16,36,62,.05)}
.higer-account .hka-kpi-ico{display:grid;place-items:center;width:38px;height:38px;border-radius:12px;background:var(--hka-paper);color:var(--hka-gold-600)}
.higer-account .hka-kpi b{display:block;margin-top:12px;font-size:22px;font-weight:900;color:var(--hka-navy-900)}
.higer-account .hka-kpi span{display:block;margin-top:2px;font-size:11.5px;font-weight:700;color:var(--hka-navy-600)}

.higer-account .hka-panel-box{margin-top:20px;padding:22px;border:1px solid var(--hka-line);border-radius:24px;background:#fff;box-shadow:0 18px 44px rgba(16,36,62,.05)}
@media(min-width:640px){.higer-account .hka-panel-box{padding:26px}}
.higer-account .hka-panel-box:first-child{margin-top:0}
.higer-account .hka-box-head{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;padding-bottom:14px;margin-bottom:16px;border-bottom:1px solid var(--hka-line)}
.higer-account .hka-box-head h2{font-size:17px}
.higer-account a.hka-box-link{display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:800;color:var(--hka-gold-600)}

/* کارت‌های سفارش */
.higer-account .hka-order-list{display:grid;gap:12px}
.higer-account .hka-order-row{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px;padding:15px 16px;border:1px solid var(--hka-line);border-radius:18px;background:#fffdf8;transition:border-color .2s}
.higer-account .hka-order-row:hover{border-color:rgba(217,161,59,.55)}
.higer-account .hka-order-id{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.higer-account .hka-order-id b{font-size:14.5px;font-weight:900;color:var(--hka-navy-900)}
.higer-account .hka-order-date{font-size:12px;color:var(--hka-navy-600);font-weight:700}
.higer-account .hka-status{display:inline-flex;align-items:center;padding:3px 10px;border-radius:9999px;font-size:11px;font-weight:900;border:1px solid}
.higer-account .hka-status.is-ok{background:#ecfdf5;border-color:#6ee7b7;color:#065f46}
.higer-account .hka-status.is-warn{background:#fffbeb;border-color:#fcd34d;color:#92400e}
.higer-account .hka-status.is-bad{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
.higer-account .hka-status.is-info{background:#eff6ff;border-color:#93c5fd;color:#1e40af}
.higer-account .hka-order-meta{display:flex;flex-wrap:wrap;align-items:center;gap:12px}
.higer-account .hka-order-total{font-size:14px;font-weight:900;color:var(--hka-navy-900)}
.higer-account .hka-order-total small{font-size:11.5px;font-weight:700;color:var(--hka-navy-600);margin-left:4px}

/* خلاصه آدرس‌ها و میان‌برها */
.higer-account .hka-addr-grid{display:grid;gap:14px;margin-top:20px}
@media(min-width:768px){.higer-account .hka-addr-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
.higer-account .hka-addr-card{padding:20px;border:1px solid var(--hka-line);border-radius:22px;background:#fff}
.higer-account .hka-addr-head{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:10px}
.higer-account .hka-addr-head h3{font-size:14.5px;display:flex;align-items:center;gap:7px}
.higer-account .hka-addr-head h3 .hka-i{color:var(--hka-gold-600)}
.higer-account .hka-addr-body{font-size:12.5px;line-height:1.95;color:var(--hka-navy-700);font-style:normal}

/* یکسان‌سازی کامل فرم‌ها و جداول بومی زیرصفحه‌های ووکامرس (سفارش، ویرایش آدرس، ویرایش حساب) */
.higer-account .hka-native table.shop_table{width:100%;border-collapse:collapse;border:1px solid var(--hka-line);border-radius:16px;overflow:hidden;margin-top:12px;font-size:13px}
.higer-account .hka-native table.shop_table :is(th,td){padding:12px 14px;border-bottom:1px solid var(--hka-line);text-align:right}
.higer-account .hka-native table.shop_table thead th{background:var(--hka-paper);font-weight:900;color:var(--hka-navy-900)}
.higer-account .hka-native .form-row{margin-bottom:14px}
.higer-account .hka-native .form-row label{display:block;margin-bottom:6px;font-size:12.5px;font-weight:800;color:var(--hka-navy-800)}
.higer-account .hka-native fieldset{margin-top:20px;padding:18px;border:1px solid var(--hka-line);border-radius:18px;background:var(--hka-cream)}
.higer-account .hka-native fieldset legend{padding:0 10px;font-size:13.5px;font-weight:900;color:var(--hka-navy-900)}
.higer-account .hka-native :is(button[type="submit"],.button,.woocommerce-Button){display:inline-flex;align-items:center;justify-content:center;gap:7px;border:0;border-radius:9999px;padding:11px 22px;background:linear-gradient(180deg,#ecc470 0%,#d9a13b 55%,#c8892a 100%);color:var(--hka-navy-900)!important;font:inherit;font-size:13px;font-weight:900;cursor:pointer;box-shadow:0 8px 20px rgba(217,161,59,.3)}
.higer-account .hka-native .woocommerce-Addresses{display:grid;gap:16px}
@media(min-width:768px){.higer-account .hka-native .woocommerce-Addresses{grid-template-columns:repeat(2,minmax(0,1fr))}}
.higer-account .hka-native .woocommerce-Address{float:none!important;width:100%!important;padding:18px;border:1px solid var(--hka-line);border-radius:20px;background:var(--hka-cream)}
.higer-account .hka-native .select2-container .select2-selection--single{height:46px;border:1.5px solid var(--hka-line);border-radius:14px;background:#fffdf6;display:flex;align-items:center;padding-inline:8px}
.higer-account .hka-native .select2-container--default .select2-selection--single .select2-selection__arrow{height:44px}
</style>

<script id="higer-account-script">
(function () {
  if (window.__higerAccountInit) return;
  window.__higerAccountInit = true;

  var FONTS = [
    'https://cdn.jsdelivr.net/gh/saraf-io/iransans-font@master/font-face.css',
    'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css'
  ];

  function addFonts() {
    var head = document.head || document.documentElement;
    FONTS.forEach(function (href) {
      if (document.querySelector('link[href="' + href + '"]')) return;
      var l = document.createElement('link');
      l.rel = 'stylesheet';
      l.href = href;
      head.appendChild(l);
    });
  }

  function mount(root) {
    if (root.getAttribute('data-hka-mounted')) return;
    root.setAttribute('data-hka-mounted', '1');

    if (root.getAttribute('data-hka-fw') === 'yes') {
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
      window.setTimeout(fit, 500);
    }

    /* تب‌بندی ورود / ثبت‌نام در حالت مهمان */
    var tabs = root.querySelectorAll('[data-hka-tab]');
    var panes = root.querySelectorAll('[data-hka-pane]');
    if (tabs.length && panes.length) {
      tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
          var target = btn.getAttribute('data-hka-tab');
          tabs.forEach(function (t) {
            t.setAttribute('aria-selected', t.getAttribute('data-hka-tab') === target ? 'true' : 'false');
          });
          panes.forEach(function (p) {
            p.hidden = p.getAttribute('data-hka-pane') !== target;
          });
        });
      });
    }

    /* دکمه نمایش / مخفی‌سازی رمز عبور */
    root.querySelectorAll('[data-hka-eye]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var wrap = btn.closest('.hka-pass-wrap');
        var input = wrap ? wrap.querySelector('input') : null;
        if (!input) return;
        input.type = input.type === 'password' ? 'text' : 'password';
      });
    });
  }

  function init() {
    addFonts();
    Array.prototype.forEach.call(document.querySelectorAll('.higer-account'), mount);
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
   بخش ۴ — خروجی HTML و ثبت شورت‌کد [higer_account]
   ============================================================ */

/* رندر پیشخوان اختصاصی مشتری واردشده */
if ( ! function_exists( 'higer_account_render_dashboard' ) ) {
	function higer_account_render_dashboard( $user, $cfg ) {
		$uid        = (int) $user->ID;
		$limit      = isset( $cfg['behavior']['recent_orders_count'] ) ? max( 1, (int) $cfg['behavior']['recent_orders_count'] ) : 5;
		$orders     = function_exists( 'wc_get_orders' ) ? wc_get_orders( array( 'customer_id' => $uid, 'limit' => $limit, 'orderby' => 'date', 'order' => 'DESC' ) ) : array();
		$all_ids    = function_exists( 'wc_get_orders' ) ? wc_get_orders( array( 'customer_id' => $uid, 'limit' => -1, 'return' => 'ids' ) ) : array();
		$active_ids = function_exists( 'wc_get_orders' ) ? wc_get_orders( array( 'customer_id' => $uid, 'status' => array( 'pending', 'processing', 'on-hold' ), 'limit' => -1, 'return' => 'ids' ) ) : array();
		$done_ids   = function_exists( 'wc_get_orders' ) ? wc_get_orders( array( 'customer_id' => $uid, 'status' => array( 'completed' ), 'limit' => -1, 'return' => 'ids' ) ) : array();

		$ship_city  = get_user_meta( $uid, 'shipping_city', true );
		if ( ! $ship_city ) {
			$ship_city = get_user_meta( $uid, 'billing_city', true );
		}

		$orders_url = function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_account_endpoint_url( 'orders' ) : '#';
		$addr_url   = function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_account_endpoint_url( 'edit-address' ) : '#';
		$edit_url   = function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_account_endpoint_url( 'edit-account' ) : '#';
		$my_phone   = get_user_meta( $uid, 'hka_primary_phone', true );
		if ( ! $my_phone ) {
			$my_phone = get_user_meta( $uid, 'billing_phone', true );
		}
		$my_email   = $user->user_email;
		$hide_email = ! $my_email || false !== strpos( $my_email, '@guests.higermattress.ir' );

		$bill_fmt = ( function_exists( 'WC' ) && WC()->countries ) ? WC()->countries->get_formatted_address( array(
			'first_name' => get_user_meta( $uid, 'billing_first_name', true ),
			'last_name'  => get_user_meta( $uid, 'billing_last_name', true ),
			'state'      => get_user_meta( $uid, 'billing_state', true ),
			'city'       => get_user_meta( $uid, 'billing_city', true ),
			'address_1'  => get_user_meta( $uid, 'billing_address_1', true ),
			'postcode'   => get_user_meta( $uid, 'billing_postcode', true ),
		) ) : '';

		$ship_fmt = ( function_exists( 'WC' ) && WC()->countries ) ? WC()->countries->get_formatted_address( array(
			'first_name' => get_user_meta( $uid, 'shipping_first_name', true ),
			'last_name'  => get_user_meta( $uid, 'shipping_last_name', true ),
			'state'      => get_user_meta( $uid, 'shipping_state', true ),
			'city'       => get_user_meta( $uid, 'shipping_city', true ),
			'address_1'  => get_user_meta( $uid, 'shipping_address_1', true ),
			'postcode'   => get_user_meta( $uid, 'shipping_postcode', true ),
		) ) : '';
		?>
		<div class="hka-kpis">
			<div class="hka-kpi">
				<span class="hka-kpi-ico"><?php echo higer_account_icon( 'package', 18 ); // phpcs:ignore ?></span>
				<b><?php echo esc_html( higer_account_fa( count( $all_ids ) ) ); ?></b>
				<span>کل سفارش‌های ثبت‌شده</span>
			</div>
			<div class="hka-kpi">
				<span class="hka-kpi-ico"><?php echo higer_account_icon( 'clock', 18 ); // phpcs:ignore ?></span>
				<b><?php echo esc_html( higer_account_fa( count( $active_ids ) ) ); ?></b>
				<span>سفارش در جریان</span>
			</div>
			<div class="hka-kpi">
				<span class="hka-kpi-ico"><?php echo higer_account_icon( 'check', 18 ); // phpcs:ignore ?></span>
				<b><?php echo esc_html( higer_account_fa( count( $done_ids ) ) ); ?></b>
				<span>تکمیل و تحویل‌شده</span>
			</div>
			<div class="hka-kpi">
				<span class="hka-kpi-ico"><?php echo higer_account_icon( 'pin', 18 ); // phpcs:ignore ?></span>
				<b><?php echo '' !== trim( (string) $ship_city ) ? esc_html( $ship_city ) : 'ثبت‌نشده'; ?></b>
				<span>شهر مقصد پیش‌فرض</span>
			</div>
		</div>

		<div class="hka-panel-box">
			<div class="hka-box-head">
				<h2>آخرین سفارش‌های شما</h2>
				<?php if ( ! empty( $orders ) ) : ?>
					<a class="hka-box-link" href="<?php echo esc_url( $orders_url ); ?>">همه سفارش‌ها <?php echo higer_account_icon( 'arrow-l', 14 ); // phpcs:ignore ?></a>
				<?php endif; ?>
			</div>

			<?php if ( empty( $orders ) ) : ?>
				<p style="font-size:13px;color:var(--hka-navy-700);line-height:2">هنوز سفارشی با این حساب ثبت نشده است. می‌توانید مدل‌های تشک هیگر را در فروشگاه بررسی کنید یا از تشک‌سنج هوشمند کمک بگیرید.</p>
				<div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:14px">
					<a class="hka-btn-gold" href="<?php echo esc_url( $cfg['urls']['shop'] ); ?>"><?php echo higer_account_icon( 'bag', 15 ); // phpcs:ignore ?> مشاهده فروشگاه</a>
					<a class="hka-btn-dark" href="<?php echo esc_url( $cfg['urls']['finder'] ); ?>"><?php echo higer_account_icon( 'moon', 14 ); // phpcs:ignore ?> تشک‌سنج هوشمند</a>
				</div>
			<?php else : ?>
				<div class="hka-order-list">
					<?php foreach ( $orders as $order ) :
						$st_slug  = $order->get_status();
						$st_name  = function_exists( 'wc_get_order_status_name' ) ? wc_get_order_status_name( $st_slug ) : $st_slug;
						$tone     = higer_account_status_tone( $st_slug );
						$date_obj = $order->get_date_created();
						$date_txt = ( $date_obj && function_exists( 'wc_format_datetime' ) ) ? wc_format_datetime( $date_obj ) : '';
						$item_cnt = $order->get_item_count();
						$view_url = $order->get_view_order_url();
						?>
						<div class="hka-order-row">
							<div>
								<div class="hka-order-id">
									<b>سفارش #<?php echo esc_html( higer_account_fa( $order->get_order_number() ) ); ?></b>
									<span class="hka-status is-<?php echo esc_attr( $tone ); ?>"><?php echo esc_html( $st_name ); ?></span>
								</div>
								<?php if ( $date_txt ) : ?>
									<div class="hka-order-date"><?php echo esc_html( higer_account_fa( $date_txt ) ); ?> • <?php echo esc_html( higer_account_fa( $item_cnt ) ); ?> قلم کالا</div>
								<?php endif; ?>
							</div>
							<div class="hka-order-meta">
								<span class="hka-order-total"><?php echo wp_kses_post( higer_account_fa( $order->get_formatted_order_total() ) ); ?></span>
								<?php if ( $order->needs_payment() ) : ?>
									<a class="hka-btn-gold" style="padding:8px 16px;font-size:12px" href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>">پرداخت</a>
								<?php endif; ?>
								<a class="hka-btn-dark" href="<?php echo esc_url( $view_url ); ?>">جزئیات فاکتور</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="hka-addr-grid">
			<div class="hka-addr-card">
				<div class="hka-addr-head">
					<h3><?php echo higer_account_icon( 'pin', 16 ); // phpcs:ignore ?> نشانی صورتحساب و تماس</h3>
					<a class="hka-box-link" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing', $addr_url ) ); ?>"><?php echo higer_account_icon( 'edit', 13 ); // phpcs:ignore ?> ویرایش</a>
				</div>
				<address class="hka-addr-body">
					<?php echo '' !== trim( (string) $bill_fmt ) ? wp_kses_post( higer_account_fa( $bill_fmt ) ) : 'هنوز نشانی صورتحساب ثبت نشده است.'; ?>
				</address>
			</div>

			<div class="hka-addr-card">
				<div class="hka-addr-head">
					<h3><?php echo higer_account_icon( 'package', 16 ); // phpcs:ignore ?> نشانی تحویل تشک</h3>
					<a class="hka-box-link" href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping', $addr_url ) ); ?>"><?php echo higer_account_icon( 'edit', 13 ); // phpcs:ignore ?> ویرایش</a>
				</div>
				<address class="hka-addr-body">
					<?php echo '' !== trim( (string) $ship_fmt ) ? wp_kses_post( higer_account_fa( $ship_fmt ) ) : 'هنوز نشانی تحویل جداگانه‌ای ثبت نشده است.'; ?>
				</address>
			</div>
		</div>

		<div class="hka-panel-box">
			<div class="hka-box-head">
				<h2>اطلاعات تماس شما (شماره همراه و ایمیل)</h2>
				<a class="hka-box-link" href="<?php echo esc_url( $edit_url ); ?>">ویرایش در جزئیات حساب <?php echo higer_account_icon( 'arrow-l', 14 ); // phpcs:ignore ?></a>
			</div>
			<div class="hka-contact-card">
				<div class="hka-contact-row">
					<span class="hka-contact-ico"><?php echo higer_account_icon( 'phone', 16 ); // phpcs:ignore ?></span>
					<div>
						<small>شماره همراه حساب (شناسه ورود و دریافت اطلاعیه سفارش)</small>
						<b><?php echo '' !== trim( (string) $my_phone ) ? esc_html( higer_account_fa( $my_phone ) ) : 'ثبت‌نشده — لطفاً اضافه کنید'; ?></b>
					</div>
					<a class="hka-contact-edit" href="<?php echo esc_url( $edit_url ); ?>"><?php echo higer_account_icon( 'edit', 13 ); // phpcs:ignore ?> ویرایش</a>
				</div>
				<div class="hka-contact-row">
					<span class="hka-contact-ico"><?php echo higer_account_icon( 'mail', 16 ); // phpcs:ignore ?></span>
					<div>
						<small>نشانی ایمیل (اختیاری — برای رسید سفارش)</small>
						<b><?php echo ! $hide_email ? esc_html( $my_email ) : 'ثبت‌نشده'; ?></b>
					</div>
					<a class="hka-contact-edit" href="<?php echo esc_url( $edit_url ); ?>"><?php echo higer_account_icon( 'edit', 13 ); // phpcs:ignore ?> ویرایش</a>
				</div>
			</div>
			<p style="margin-top:12px;font-size:11.5px;line-height:1.9;color:var(--hka-navy-600)">
				شماره همراه ثبت‌شده، شناسه اصلی حساب شماست و برای ورود بعدی استفاده می‌شود. برای هماهنگی زمان ارسال، این شماره همیشه به‌روز نگه داشته شود.
			</p>
		</div>

		<div class="hka-panel-box">
			<div class="hka-box-head">
				<h2>دسترسی سریع حساب</h2>
				<a class="hka-box-link" href="<?php echo esc_url( $edit_url ); ?>">تغییر نام و رمز عبور <?php echo higer_account_icon( 'arrow-l', 14 ); // phpcs:ignore ?></a>
			</div>
			<div style="display:flex;flex-wrap:wrap;gap:10px">
				<a class="hka-btn-dark" href="<?php echo esc_url( $edit_url ); ?>"><?php echo higer_account_icon( 'settings', 14 ); // phpcs:ignore ?> ویرایش اطلاعات حساب</a>
				<a class="hka-btn-dark" href="<?php echo esc_url( $cfg['urls']['cart'] ); ?>"><?php echo higer_account_icon( 'bag', 14 ); // phpcs:ignore ?> مشاهده سبد خرید</a>
				<a class="hka-btn-dark" href="<?php echo esc_url( $cfg['store']['whatsapp_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_account_icon( 'whatsapp', 14 ); // phpcs:ignore ?> گفتگوی واتساپ با پشتیبانی</a>
			</div>
		</div>
		<?php
		do_action( 'woocommerce_account_dashboard' );
	}
}

/* رندر اصلی شورت‌کد [higer_account] */
if ( ! function_exists( 'higer_account_render' ) ) {
	function higer_account_render( $atts = array() ) {
		$atts = function_exists( 'shortcode_atts' )
			? shortcode_atts( array( 'fullwidth' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_account' )
			: array( 'fullwidth' => 'yes' );

		$cfg       = higer_account_config();
		$store     = $cfg['store'];
		$beh       = $cfg['behavior'];
		$fullwidth = 'no' !== strtolower( (string) $atts['fullwidth'] );
		$uid_attr  = 'hka-' . substr( md5( uniqid( 'higer-account', true ) ), 0, 6 );
		$acct_url  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' );

		if ( ! empty( $beh['suppress_footer_cta'] ) ) {
			$GLOBALS['higer_suppress_footer_cta'] = true;
		}
		if ( function_exists( 'nocache_headers' ) && ! headers_sent() ) {
			nocache_headers();
		}

		$notices = ( function_exists( 'WC' ) && WC() && ! empty( WC()->session ) && function_exists( 'wc_print_notices' ) )
			? (string) wc_print_notices( true )
			: '';

		$is_lost_pw = function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'lost-password' );
		$logged_in  = function_exists( 'is_user_logged_in' ) && is_user_logged_in();

		ob_start();
		echo higer_account_assets(); // phpcs:ignore
		?>
<div class="higer-account" id="<?php echo esc_attr( $uid_attr ); ?>" dir="rtl" lang="fa" data-hka-fw="<?php echo $fullwidth ? 'yes' : 'no'; ?>">

	<?php if ( ! $logged_in ) :
		$guest        = $cfg['guest'];
		$reg_enabled  = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
		$gen_username = 'no' !== get_option( 'woocommerce_registration_generate_username' );
		$gen_password = 'yes' === get_option( 'woocommerce_registration_generate_password' );
		$active_tab   = ( $reg_enabled && isset( $_POST['register'] ) ) ? 'register' : 'login'; // phpcs:ignore WordPress.Security.NonceVerification
		?>
		<!-- ===== سربرگ حالت ورود / بازیابی رمز ===== -->
		<section class="hka-hero">
			<div class="hka-wrap">
				<nav class="hka-crumbs" aria-label="مسیر صفحه">
					<ol>
						<li><a href="<?php echo esc_url( $cfg['urls']['home'] ); ?>">خانه</a></li>
						<?php if ( $is_lost_pw ) : ?>
							<li><a href="<?php echo esc_url( $acct_url ); ?>">حساب کاربری</a></li>
							<li aria-current="page">بازیابی رمز عبور</li>
						<?php else : ?>
							<li aria-current="page">حساب کاربری</li>
						<?php endif; ?>
					</ol>
				</nav>
				<span class="hka-kicker is-dark"><?php echo higer_account_icon( 'lock', 13 ); // phpcs:ignore ?> <?php echo esc_html( $guest['kicker'] ); ?></span>
				<h1 class="hka-hero-title">
					<?php if ( $is_lost_pw ) : ?>
						بازیابی <span class="hka-gold-text">رمز عبور</span>
					<?php else : ?>
						<?php echo esc_html( $guest['title_a'] ); ?><span class="hka-gold-text"><?php echo esc_html( $guest['title_b'] ); ?></span>
					<?php endif; ?>
				</h1>
				<p class="hka-hero-sub"><?php echo esc_html( $guest['subtitle'] ); ?></p>
			</div>
		</section>

		<section class="hka-body">
			<div class="hka-wrap">
				<?php if ( '' !== trim( $notices ) ) : ?>
					<div class="hka-notices"><?php echo $notices; // phpcs:ignore ?></div>
				<?php endif; ?>

				<?php if ( $is_lost_pw && class_exists( 'WC_Shortcode_My_Account' ) ) : ?>
					<div class="hka-auth-card hka-native" style="max-width:36rem;margin-inline:auto">
						<?php WC_Shortcode_My_Account::lost_password(); ?>
						<div style="margin-top:18px;padding-top:14px;border-top:1px solid var(--hka-line)">
							<a class="hka-box-link" href="<?php echo esc_url( $acct_url ); ?>"><?php echo higer_account_icon( 'arrow-r', 14 ); // phpcs:ignore ?> بازگشت به صفحه ورود</a>
						</div>
					</div>
				<?php else : ?>
					<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
					<div class="hka-auth-grid">
						<div class="hka-auth-card">
							<?php if ( $reg_enabled ) : ?>
							<div class="hka-auth-tabs" role="tablist" aria-label="ورود یا ثبت‌نام">
								<button type="button" class="hka-auth-tab" role="tab" data-hka-tab="login" aria-selected="<?php echo 'login' === $active_tab ? 'true' : 'false'; ?>">ورود به حساب</button>
								<button type="button" class="hka-auth-tab" role="tab" data-hka-tab="register" aria-selected="<?php echo 'register' === $active_tab ? 'true' : 'false'; ?>">ثبت‌نام سریع</button>
							</div>
							<?php else : ?>
							<div class="hka-box-head"><h2>ورود به حساب کاربری</h2></div>
							<?php endif; ?>

							<!-- پنل ورود استاندارد ووکامرس -->
							<div data-hka-pane="login"<?php echo 'login' !== $active_tab ? ' hidden' : ''; ?>>
								<form class="woocommerce-form woocommerce-form-login login" method="post">
									<?php do_action( 'woocommerce_login_form_start' ); ?>
									<div class="hka-field">
										<label for="hka-username">شماره همراه، نام کاربری یا ایمیل <i>*</i></label>
										<input type="tel" name="username" id="hka-username" dir="ltr" inputmode="tel" autocomplete="username" placeholder="091111186485" value="<?php echo ! empty( $_POST['username'] ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; // phpcs:ignore ?>" required>
									</div>
									<div class="hka-field">
										<label for="hka-password">رمز عبور <i>*</i></label>
										<div class="hka-pass-wrap">
											<input type="password" name="password" id="hka-password" autocomplete="current-password" required>
											<button type="button" class="hka-eye-btn" data-hka-eye aria-label="نمایش یا مخفی کردن رمز عبور"><?php echo higer_account_icon( 'eye', 17 ); // phpcs:ignore ?></button>
										</div>
									</div>

									<div class="hka-native"><?php do_action( 'woocommerce_login_form' ); ?></div>

									<div class="hka-auth-row">
										<label class="hka-remember">
											<input name="rememberme" type="checkbox" value="forever">
											<span>مرا به خاطر بسپار</span>
										</label>
										<a class="hka-lost-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">رمز عبور را فراموش کرده‌اید؟</a>
									</div>

									<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
									<button type="submit" class="hka-btn-gold hka-auth-submit" name="login" value="ورود">
										<span>ورود به حساب کاربری</span>
										<?php echo higer_account_icon( 'arrow-l', 16 ); // phpcs:ignore ?>
									</button>
									<?php do_action( 'woocommerce_login_form_end' ); ?>
								</form>
							</div>

							<!-- پنل ثبت‌نام استاندارد ووکامرس -->
							<?php if ( $reg_enabled ) : ?>
							<div data-hka-pane="register"<?php echo 'register' !== $active_tab ? ' hidden' : ''; ?>>
								<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
									<?php do_action( 'woocommerce_register_form_start' ); ?>

									<div class="hka-field">
										<label for="hka-mobile">شماره همراه <i>*</i></label>
										<input type="tel" name="hka_mobile" id="hka-mobile" dir="ltr" inputmode="tel" autocomplete="tel" placeholder="091111186485" value="<?php echo ! empty( $_POST['hka_mobile'] ) ? esc_attr( wp_unslash( $_POST['hka_mobile'] ) ) : ''; // phpcs:ignore ?>" required>
									</div>

									<?php if ( ! $gen_username ) : ?>
									<div class="hka-field">
										<label for="hka-reg-username">نام کاربری دلخواه <i>*</i></label>
										<input type="text" name="username" id="hka-reg-username" autocomplete="username" value="<?php echo ! empty( $_POST['username'] ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; // phpcs:ignore ?>" required>
									</div>
									<?php endif; ?>

									<div class="hka-field<?php echo ! empty( $cfg['registration']['email_required'] ) ? '' : ' hka-field-optional'; ?>">
										<label for="hka-reg-email">
											نشانی ایمیل <?php echo ! empty( $cfg['registration']['email_required'] ) ? '<i>*</i>' : '<small class="hka-opt-tag">اختیاری</small>'; ?>
										</label>
										<input type="email" name="hka_email" id="hka-reg-email" dir="ltr" autocomplete="email" value="<?php echo ! empty( $_POST['hka_email'] ) ? esc_attr( wp_unslash( $_POST['hka_email'] ) ) : ''; // phpcs:ignore ?>">
									</div>

									<div class="hka-field-row">
										<div class="hka-field">
											<label for="hka-first-name">نام</label>
											<input type="text" name="hka_first_name" id="hka-first-name" autocomplete="given-name" value="<?php echo ! empty( $_POST['hka_first_name'] ) ? esc_attr( wp_unslash( $_POST['hka_first_name'] ) ) : ''; // phpcs:ignore ?>">
										</div>
										<div class="hka-field">
											<label for="hka-last-name">نام خانوادگی</label>
											<input type="text" name="hka_last_name" id="hka-last-name" autocomplete="family-name" value="<?php echo ! empty( $_POST['hka_last_name'] ) ? esc_attr( wp_unslash( $_POST['hka_last_name'] ) ) : ''; // phpcs:ignore ?>">
										</div>
									</div>

									<?php if ( ! $gen_password ) : ?>
									<div class="hka-field">
										<label for="hka-reg-password">انتخاب رمز عبور <i>*</i></label>
										<div class="hka-pass-wrap">
											<input type="password" name="password" id="hka-reg-password" autocomplete="new-password" required>
											<button type="button" class="hka-eye-btn" data-hka-eye aria-label="نمایش یا مخفی کردن رمز عبور"><?php echo higer_account_icon( 'eye', 17 ); // phpcs:ignore ?></button>
										</div>
									</div>
									<?php else : ?>
									<p class="hka-privacy-note">رمز عبور حساب شما به‌صورت خودکار ساخته می‌شود و لینک تنظیم آن به شماره همراه یا ایمیل شما ارسال می‌گردد.</p>
									<?php endif; ?>

									<?php if ( ! empty( $cfg['registration']['note'] ) ) : ?>
										<p class="hka-phone-note"><?php echo higer_account_icon( 'phone', 14 ); // phpcs:ignore ?> <span><?php echo esc_html( $cfg['registration']['note'] ); ?></span></p>
									<?php endif; ?>

									<div class="hka-native"><?php do_action( 'woocommerce_register_form' ); ?></div>

									<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
									<button type="submit" class="hka-btn-gold hka-auth-submit" name="register" value="عضویت">
										<span>ایجاد حساب کاربری در هیگر</span>
										<?php echo higer_account_icon( 'arrow-l', 16 ); // phpcs:ignore ?>
									</button>
									<?php do_action( 'woocommerce_register_form_end' ); ?>
								</form>
							</div>
							<?php endif; ?>
						</div>

						<!-- ستون مزایای عضویت و پیگیری سریع -->
						<aside class="hka-guest-side">
							<span class="hka-kicker is-dark"><?php echo higer_account_icon( 'shield', 12 ); // phpcs:ignore ?> <?php echo esc_html( $guest['side_kicker'] ); ?></span>
							<h2><?php echo esc_html( $guest['side_title'] ); ?></h2>
							<div class="hka-benefit-list">
								<?php foreach ( (array) $guest['benefits'] as $b ) : ?>
									<div class="hka-benefit">
										<span class="hka-benefit-ico"><?php echo higer_account_icon( $b['icon'], 18 ); // phpcs:ignore ?></span>
										<div>
											<b><?php echo esc_html( $b['title'] ); ?></b>
											<small><?php echo esc_html( $b['sub'] ); ?></small>
										</div>
									</div>
								<?php endforeach; ?>
							</div>

							<div class="hka-track-box">
								<p><?php echo esc_html( $guest['track_note'] ); ?></p>
								<div class="hka-track-btns">
									<a class="hka-btn-outline" href="<?php echo esc_url( $store['whatsapp_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_account_icon( 'whatsapp', 15 ); // phpcs:ignore ?> پیگیری در واتساپ</a>
									<a class="hka-btn-outline" href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_account_icon( 'phone', 14 ); // phpcs:ignore ?> <span dir="ltr"><?php echo esc_html( $store['phone'] ); ?></span></a>
								</div>
							</div>
						</aside>
					</div>
					<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
				<?php endif; ?>
			</div>
		</section>

	<?php else :
		/* ─── حالت واردشده: پورتال اختصاصی مشتری ─── */
		$user          = wp_get_current_user();
		$display_name  = $user->display_name ? $user->display_name : $user->user_login;
		$first_char    = function_exists( 'mb_substr' ) ? mb_substr( $display_name, 0, 1 ) : substr( $display_name, 0, 1 );
		$phone_meta    = get_user_meta( $user->ID, 'billing_phone', true );
		$endpoint      = higer_account_current_endpoint();
		$menu_items    = function_exists( 'wc_get_account_menu_items' ) ? wc_get_account_menu_items() : array();
		$order_ids_all = function_exists( 'wc_get_orders' ) ? wc_get_orders( array( 'customer_id' => (int) $user->ID, 'limit' => -1, 'return' => 'ids' ) ) : array();
		$order_total_c = count( $order_ids_all );
		$logout_url    = function_exists( 'wc_logout_url' ) ? wc_logout_url() : wp_logout_url( $acct_url );
		$ep_label      = isset( $menu_items[ $endpoint ] ) ? $menu_items[ $endpoint ] : ( 'view-order' === $endpoint ? 'جزئیات فاکتور سفارش' : '' );
		?>
		<section class="hka-hero">
			<div class="hka-wrap">
				<nav class="hka-crumbs" aria-label="مسیر صفحه">
					<ol>
						<li><a href="<?php echo esc_url( $cfg['urls']['home'] ); ?>">خانه</a></li>
						<?php if ( 'dashboard' === $endpoint ) : ?>
							<li aria-current="page">حساب کاربری</li>
						<?php else : ?>
							<li><a href="<?php echo esc_url( $acct_url ); ?>">حساب کاربری</a></li>
							<?php if ( $ep_label ) : ?><li aria-current="page"><?php echo esc_html( $ep_label ); ?></li><?php endif; ?>
						<?php endif; ?>
					</ol>
				</nav>

				<div class="hka-hero-user">
					<div class="hka-user-id">
						<div class="hka-avatar"><?php echo esc_html( $first_char ); ?></div>
						<div>
							<span class="hka-kicker is-dark"><?php echo higer_account_icon( 'user', 12 ); // phpcs:ignore ?> <?php echo esc_html( $cfg['portal']['kicker'] ); ?></span>
							<h1 class="hka-hero-title"><?php echo esc_html( $cfg['portal']['welcome'] ); ?><span class="hka-gold-text"><?php echo esc_html( $display_name ); ?></span></h1>
							<div class="hka-user-meta">
								<?php $primary_phone = get_user_meta( $user->ID, 'hka_primary_phone', true ); if ( ! $primary_phone ) { $primary_phone = $phone_meta; } ?>
								<?php if ( $primary_phone ) : ?>
									<span class="hka-meta-pill" dir="ltr"><?php echo esc_html( higer_account_fa( $primary_phone ) ); ?></span>
								<?php endif; ?>
								<?php
								/* ایمیل رزرو درونی (guests.higermattress.ir) در پیشخوان مشتری نمایش داده نمی‌شود */
								$show_email = $user->user_email && false === strpos( $user->user_email, '@guests.higermattress.ir' );
								if ( $show_email ) : ?>
									<span class="hka-meta-pill" dir="ltr"><?php echo esc_html( $user->user_email ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="hka-hero-btns">
						<a class="hka-btn-gold" href="<?php echo esc_url( $cfg['urls']['shop'] ); ?>"><?php echo higer_account_icon( 'bag', 15 ); // phpcs:ignore ?> فروشگاه هیگر</a>
						<a class="hka-btn-outline" href="<?php echo esc_url( $logout_url ); ?>"><?php echo higer_account_icon( 'logout', 15 ); // phpcs:ignore ?> خروج از حساب</a>
					</div>
				</div>
			</div>
		</section>

		<section class="hka-body">
			<div class="hka-wrap">
				<?php if ( '' !== trim( $notices ) ) : ?>
					<div class="hka-notices"><?php echo $notices; // phpcs:ignore ?></div>
				<?php endif; ?>

				<div class="hka-portal-grid">
					<!-- ناوبری کناری حساب کاربری -->
					<aside class="hka-nav-col" aria-label="منوی حساب کاربری">
						<nav class="hka-nav-card">
							<ul class="hka-menu">
								<?php foreach ( $menu_items as $ep => $label ) :
									$url       = function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_account_endpoint_url( $ep ) : '#';
									$is_active = ( $ep === $endpoint ) || ( 'orders' === $ep && 'view-order' === $endpoint );
									$cls       = ( $is_active ? 'is-active ' : '' ) . ( 'customer-logout' === $ep ? 'is-logout' : '' );
									?>
									<li>
										<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( trim( $cls ) ); ?>">
											<?php echo higer_account_icon( higer_account_endpoint_icon( $ep ), 17 ); // phpcs:ignore ?>
											<span><?php echo esc_html( $label ); ?></span>
											<?php if ( 'orders' === $ep && $order_total_c > 0 ) : ?>
												<span class="hka-menu-badge"><?php echo esc_html( higer_account_fa( $order_total_c ) ); ?></span>
											<?php endif; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>

						<div class="hka-support-mini">
							<b><?php echo higer_account_icon( 'chat', 15 ); // phpcs:ignore ?> پشتیبانی سفارش‌ها</b>
							<p>سؤال درباره زمان ارسال، تغییر سایز یا فاکتور گارانتی دارید؟</p>
							<div class="hka-support-links">
								<a href="<?php echo esc_url( $store['whatsapp_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_account_icon( 'whatsapp', 13 ); // phpcs:ignore ?> واتساپ</a>
								<a href="<?php echo esc_url( $store['telegram_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_account_icon( 'telegram', 13 ); // phpcs:ignore ?> تلگرام</a>
								<a href="<?php echo esc_url( $store['tel'] ); ?>"><?php echo higer_account_icon( 'phone', 13 ); // phpcs:ignore ?> <span dir="ltr"><?php echo esc_html( $store['phone'] ); ?></span></a>
							</div>
						</div>
					</aside>

					<!-- محتوای اصلی زیرصفحه انتخاب‌شده -->
					<div class="hka-main-col">
						<?php if ( 'dashboard' === $endpoint ) : ?>
							<?php higer_account_render_dashboard( $user, $cfg ); ?>
						<?php else : ?>
							<div class="hka-panel-box hka-native">
								<?php if ( $ep_label ) : ?>
								<div class="hka-box-head">
									<h2><?php echo esc_html( $ep_label ); ?></h2>
									<a class="hka-box-link" href="<?php echo esc_url( $acct_url ); ?>"><?php echo higer_account_icon( 'arrow-r', 14 ); // phpcs:ignore ?> بازگشت به پیشخوان</a>
								</div>
								<?php endif; ?>
								<?php do_action( 'woocommerce_account_content' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
</div>
		<?php
		return (string) ob_get_clean();
	}
}

if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_account' ) ) {
	add_shortcode( 'higer_account', 'higer_account_render' );
}

/* افزودن فیلد شماره همراه به فرم «جزئیات حساب» (edit-account) و ذخیره آن */
if ( ! function_exists( 'higer_account_add_phone_to_edit_account' ) ) {
	function higer_account_add_phone_to_edit_account() {
		$user_id = get_current_user_id();
		$phone   = get_user_meta( $user_id, 'hka_primary_phone', true );
		if ( ! $phone ) {
			$phone = get_user_meta( $user_id, 'billing_phone', true );
		}
		$billing_email = get_user_meta( $user_id, 'billing_email', true );
		?>
		<div class="hka-native" style="margin-top:6px">
			<fieldset style="border:1px solid var(--hka-line);border-radius:18px;padding:18px;background:var(--hka-cream)">
				<legend style="padding:0 10px;font-size:13.5px;font-weight:900;color:var(--hka-navy-900)">اطلاعات تماس هیگر</legend>
				<div class="form-row" style="margin-bottom:14px">
					<label for="hka-edit-phone" style="display:block;margin-bottom:6px;font-size:12.5px;font-weight:800;color:var(--hka-navy-800)">
						شماره همراه حساب (شناسه ورود) <span style="color:var(--hka-gold-600)">*</span>
					</label>
					<input type="tel" name="hka_edit_phone" id="hka-edit-phone" dir="ltr" inputmode="tel"
						style="width:100%;border:1.5px solid var(--hka-line);border-radius:14px;padding:12px 14px;background:#fffdf6;font:inherit;font-size:13.5px;font-weight:700;outline:none"
						value="<?php echo esc_attr( higer_account_fa( $phone ) ); ?>">
					<small style="display:block;margin-top:5px;font-size:11px;color:var(--hka-navy-600)">
						این شماره، شناسه اصلی ورود شماست و تغییر آن برای دریافت اطلاعیه‌های سفارش ضروری است.
					</small>
				</div>
				<?php if ( $billing_email ) : ?>
					<div class="form-row" style="margin-bottom:14px">
						<label for="hka-edit-billing-email" style="display:block;margin-bottom:6px;font-size:12.5px;font-weight:800;color:var(--hka-navy-800)">
							نشانی ایمیل برای رسید سفارش
						</label>
						<input type="email" name="hka_edit_billing_email" id="hka-edit-billing-email" dir="ltr"
							style="width:100%;border:1.5px solid var(--hka-line);border-radius:14px;padding:12px 14px;background:#fffdf6;font:inherit;font-size:13.5px;font-weight:700;outline:none"
							value="<?php echo esc_attr( $billing_email ); ?>">
					</div>
				<?php endif; ?>
			</fieldset>
		</div>
		<?php
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'woocommerce_after_edit_account_form', 'higer_account_add_phone_to_edit_account', 20 );
	}
}

/* ذخیره شماره همراه ویرایش‌شده در فرم جزئیات حساب */
if ( ! function_exists( 'higer_account_save_edit_account_phone' ) ) {
	function higer_account_save_edit_account_phone( $user_id ) {
		if ( ! isset( $_POST['save-account-details'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		$phone = isset( $_POST['hka_edit_phone'] ) ? higer_account_normalize_phone( wp_unslash( $_POST['hka_edit_phone'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification

		if ( '' !== $phone ) {
			if ( strlen( $phone ) < 10 ) {
				if ( function_exists( 'wc_add_notice' ) ) {
					wc_add_notice( 'شماره همراه واردشده معتبر نیست. مثال صحیح: ۰۹۱۱۱۱۸۶۴۸۵', 'error' );
				}
				return;
			}
			$existing = higer_account_find_user_by_phone( $phone );
			if ( $existing && (int) $existing->ID !== (int) $user_id ) {
				if ( function_exists( 'wc_add_notice' ) ) {
					wc_add_notice( 'این شماره همراه به حساب کاربری دیگری متصل است.', 'error' );
				}
				return;
			}
			update_user_meta( $user_id, 'billing_phone', $phone );
			update_user_meta( $user_id, 'shipping_phone', $phone );
			update_user_meta( $user_id, 'hka_primary_phone', $phone );
		}

		if ( isset( $_POST['hka_edit_billing_email'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			$be = sanitize_email( wp_unslash( $_POST['hka_edit_billing_email'] ) ); // phpcs:ignore WordPress.Security.NonceVerification
			if ( is_email( $be ) ) {
				update_user_meta( $user_id, 'billing_email', $be );
				update_user_meta( $user_id, 'shipping_email', $be );
			}
		}
	}
	if ( function_exists( 'add_action' ) ) {
		add_action( 'woocommerce_save_account_details', 'higer_account_save_edit_account_phone', 15 );
	}
}

/* حالت بدون المنتور: جایگزینی خودکار محتوای برگه حساب کاربری */
if ( ! function_exists( 'higer_account_auto_content' ) ) {
	function higer_account_auto_content( $content ) {
		$cfg = higer_account_config();
		if ( empty( $cfg['behavior']['auto_content'] ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}
		$is_target = ( function_exists( 'is_account_page' ) && is_account_page() )
			|| ( function_exists( 'is_page' ) && ! empty( $cfg['behavior']['page_slug'] ) && is_page( $cfg['behavior']['page_slug'] ) );
		return $is_target ? higer_account_render() : $content;
	}
	if ( function_exists( 'add_filter' ) ) {
		add_filter( 'the_content', 'higer_account_auto_content', 20 );
	}
}
