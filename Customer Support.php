<?php
/**
 * Higer Support — صفحه «پشتیبانی مشتریان» تشک هیگر | نسخه بدون بیلد (v1)
 * =====================================================================
 * اسنیپت PHP مستقل برای WPCode، هم‌خانواده با Home.php، Cart.php، Checkout.php و هدر/فوتر هیگر.
 * جای صفحه‌ای که الان محتوای لورم ایپسوم دارد را با یک مرکز پشتیبانی واقعی پر می‌کند:
 * راه‌های تماس، سؤالات متداول دسته‌بندی‌شده، پیگیری سفارش و مسیر گارانتی.
 *
 * ─── نصب ───
 *  WPCode > PHP Snippet > کل فایل را Paste > Auto Insert / Run Everywhere > Activate
 *  در برگه «پشتیبانی مشتریان» یک ویجت Shortcode بگذارید:  [higer_support]
 *  یا در تنظیمات پایین 'auto_replace' را true کنید.
 *
 * ─── شورت‌کد ───
 *  [higer_support]                 صفحه کامل
 *  [higer_support hero="no"]       بدون سربرگ
 *  [higer_support fullwidth="no"]  بدون کشیدگی تمام‌عرض
 *
 * ─── نکته محتوایی ───
 *  متن سؤالات و پاسخ‌ها در آرایه config پایین است؛ همان‌جا ویرایش کنید.
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================ بخش ۱ — تنظیمات */
if ( ! function_exists( 'higer_support_config' ) ) {
	function higer_support_config() {
		$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';
		$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/';
		$cart = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : rtrim( $home, '/' ) . '/my-cart/';
		$acct = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : rtrim( $home, '/' ) . '/my-account/';

		return array(
			'auto_replace' => false,
			'store' => array(
				'name'      => 'تشک هیگر',
				'tel'       => 'tel:+989111186485',
				'phone_fa'  => '۰۹۱۱۱۱۸۶۴۸۵',
				'whatsapp'  => 'https://wa.me/989111186485?text=' . rawurlencode( 'سلام، از صفحه پشتیبانی تشک هیگر پیام می‌دهم.' ),
				'telegram'  => 'https://t.me/+989111186485',
				'instagram' => 'https://www.instagram.com/higer.mattress/',
				'hours'     => 'همه‌روزه به‌جز روزهای تعطیل، ۹ تا ۲۱',
				'address'   => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی ۲۷، فروشگاه و دفتر مرکزی هیگر',
			),
			'urls' => array(
				'home'    => $home,
				'shop'    => $shop,
				'cart'    => $cart,
				'account' => $acct,
				'contact' => rtrim( $home, '/' ) . '/contact-us/',
				'tracking'=> rtrim( $home, '/' ) . '/my-account/orders/',
			),
			'hero' => array(
				'kicker'   => 'پشتیبانی و راهنمای خرید',
				'title_a'  => 'در کنار شما،',
				'title_b'  => 'از انتخاب تا خواب راحت',
				'subtitle' => 'اگر درباره سایز، ارسال، پرداخت یا گارانتی سؤالی دارید، پاسخ بیشتر پرسش‌ها اینجاست و تیم هیگر هم تلفنی و در پیام‌رسان‌ها پاسخگوست.',
			),
			'channels' => array(
				array( 'icon' => 'phone',   'title' => 'تماس مستقیم',       'sub' => '۰۹۱۱۱۱۸۶۴۸۵', 'desc' => 'سریع‌ترین راه برای مشاوره خرید', 'url_key' => 'tel' ),
				array( 'icon' => 'whatsapp','title' => 'واتساپ',             'sub' => 'گفتگوی متنی', 'desc' => 'ارسال عکس، سایز و مشخصات اتاق', 'url_key' => 'whatsapp' ),
				array( 'icon' => 'telegram','title' => 'تلگرام',             'sub' => 'پیام متنی',   'desc' => 'پیگیری درخواست‌های ثبت‌شده', 'url_key' => 'telegram' ),
				array( 'icon' => 'clock',   'title' => 'ساعت پاسخگویی',      'sub' => '۹ تا ۲۱',      'desc' => 'همه‌روزه به‌جز تعطیلات رسمی', 'url_key' => '' ),
			),
			/* سؤالات متداول؛ همین‌جا ویرایش کنید */
			'faq' => array(
				array(
					'title' => 'سفارش و ارسال',
					'icon'  => 'truck',
					'items' => array(
						array( 'q' => 'هزینه و زمان ارسال چقدر است؟', 'a' => 'هزینه و زمان ارسال بر اساس شهر مقصد و ابعاد تشک در مرحله تسویه حساب یا هماهنگی تلفنی مشخص می‌شود. ارسال به شهرهای دیگر با باربری هماهنگ‌شده انجام می‌گیرد و پیش از ارسال، زمان تحویل با شما تأیید می‌شود.' ),
						array( 'q' => 'چطور سفارشم را پیگیری کنم؟', 'a' => 'با شماره سفارش و ایمیل یا از مسیر «حساب کاربری ← سفارش‌ها» می‌توانید وضعیت سفارش را ببینید. اگر حساب ندارید، شماره سفارش را برای پشتیبانی بفرستید تا وضعیت را اعلام کنیم.' ),
						array( 'q' => 'تحویل تشک نیاز به هماهنگی دارد؟', 'a' => 'بله. پیش از ارسال، برای هماهنگی زمان، طبقه و دسترسی (آسانسور یا پله) با شما تماس گرفته می‌شود. لطفاً هنگام ثبت سفارش در «توضیحات تکمیلی» محدودیت‌ها را بنویسید.' ),
						array( 'q' => 'امکان تحویل در روز تعطیل یا ساعت خاص وجود دارد؟', 'a' => 'در صورت امکان با هماهنگی تلفنی. درخواست خود را در توضیحات سفارش یا با پشتیبانی مطرح کنید تا در برنامه ارسال لحاظ شود.' ),
					),
				),
				array(
					'title' => 'پرداخت و فاکتور',
					'icon'  => 'card',
					'items' => array(
						array( 'q' => 'چه روش‌های پرداختی دارید؟', 'a' => 'پرداخت آنلاین از طریق درگاه رسمی بانکی و در صورت نیاز کارت‌به‌کارت با هماهنگی تلفنی. هیچ‌گاه اطلاعات کارت خود را در پیام‌رسان‌ها نفرستید؛ فقط از درگاه امن سایت استفاده کنید.' ),
						array( 'q' => 'آیا امکان پرداخت در محل هست؟', 'a' => 'روش پرداخت در محل بستگی به شهر و شرایط ارسال دارد. برای اطلاع از امکان آن با پشتیبانی تماس بگیرید.' ),
						array( 'q' => 'فاکتور رسمی صادر می‌شود؟', 'a' => 'بله؛ فاکتور خرید صادر و تاریخ ثبت فاکتور مبنای شروع گارانتی است. اگر به فاکتور رسمی با مشخصات حقوقی نیاز دارید، هنگام خرید اطلاع دهید.' ),
						array( 'q' => 'کد تخفیف را کجا وارد کنم؟', 'a' => 'در صفحه سبد خرید و همچنین مرحله تسویه حساب، کادر «کد تخفیف» وجود دارد. پس از ثبت، مبلغ نهایی به‌روزرسانی می‌شود.' ),
					),
				),
				array(
					'title' => 'سایز و انتخاب تشک',
					'icon'  => 'ruler',
					'items' => array(
						array( 'q' => 'چه سایزهایی موجود است؟', 'a' => '۷۰×۱۳۰ (نوزاد)، ۸۰×۱۸۰ (نوجوان)، ۹۰×۲۰۰ و ۱۰۰×۲۰۰ (یک‌نفره)، ۱۲۰×۲۰۰ (یک‌نفره عریض)، ۱۴۰×۲۰۰ (دونفره)، ۱۶۰×۲۰۰ (کویین)، ۱۸۰×۲۰۰ (کینگ) و ۲۰۰×۲۰۰ (سوپرکینگ). دوخت سفارشی برای ابعاد خاص نیز با هماهنگی انجام می‌شود.' ),
						array( 'q' => 'چطور سایز مناسب را انتخاب کنم؟', 'a' => 'ابعاد قاب تخت و فضای آزاد اطراف را اندازه بگیرید. برای دو نفر، عرض ۱۴۰ سانتی‌متر حداقل راحتی است و ۱۶۰ و ۱۸۰ فضای بیشتری می‌دهد. کارشناسان فروش هم بر اساس قد و وزن و تعداد نفرات راهنمایی می‌کنند.' ),
						array( 'q' => 'فرق فنر متصل و فنر منفصل چیست؟', 'a' => 'در فنر متصل (بونل)، فنرها به هم وصل‌اند و حرکت یکی روی دیگری اثر می‌گذارد. در فنر منفصل (پاکتی)، هر فنر مستقل است و انتقال حرکت کمتر می‌شود؛ برای کسانی که با هم‌خواب اختلاف وزن یا سلیقه دارند مناسب‌تر است.' ),
						array( 'q' => 'ریباند و فوم سنگین چه تفاوتی دارند؟', 'a' => 'ریباند از قطعات فوم فشرده‌شده ساخته می‌شود و معمولاً اقتصادی‌تر است. فوم سنگین چگالی بالاتری دارد و برای افرادی که تشک بدون فنر و یکنواخت می‌خواهند گزینه مناسبی است.' ),
					),
				),
				array(
					'title' => 'گارانتی و خدمات پس از فروش',
					'icon'  => 'shield',
					'items' => array(
						array( 'q' => 'گارانتی از چه زمانی شروع می‌شود؟', 'a' => 'از تاریخ ثبت فاکتور. مدت گارانتی هر مدل روی صفحه همان محصول نوشته شده است.' ),
						array( 'q' => 'گارانتی شامل چه مواردی است؟', 'a' => 'گارانتی تولید و سالم‌بودن ساختار تشک (مثل شکست فنر و فرورفتگی غیرعادی) را پوشش می‌دهد. پارگی، سوختگی، لکه، برش و استفاده نادرست از شرایط گارانتی خارج است. برای جزئیات، متن گارانتی همان مدل را ببینید.' ),
						array( 'q' => 'تشک زدگی یا بوی اولیه طبیعی است؟', 'a' => 'کمی بوی مواد اولیه در روزهای اول طبیعی است و با تهویه از بین می‌رود. اگر بو ادامه داشت یا بافت غیرعادی دیدید، با پشتیبانی تماس بگیرید.' ),
						array( 'q' => 'تعمیر یا جایگزینی چطور انجام می‌شود؟', 'a' => 'با ارسال عکس و شماره فاکتور، درخواست بررسی ثبت می‌شود. در صورت تأیید کارشناس، تعمیر یا جایگزینی طبق شرایط گارانتی انجام می‌گیرد.' ),
					),
				),
				array(
					'title' => 'مرجوعی و تعویض',
					'icon'  => 'refresh',
					'items' => array(
						array( 'q' => 'شرایط مرجوعی چیست؟', 'a' => 'کالا باید سالم، بدون لکه و در بسته‌بندی و پلمب اولیه باشد. برای تشک، به دلیل مسائل بهداشتی، بازشدن پلمب و استفاده از کالا امکان مرجوعی را محدود می‌کند. پیش از باز کردن بسته‌بندی، حتماً سایز و مدل را کنترل کنید.' ),
						array( 'q' => 'تعویض سایز امکان‌پذیر است؟', 'a' => 'در صورت سالم و پلمب بودن کالا و با تأیید فروشگاه، امکان تعویض وجود دارد؛ هزینه رفت‌وبرگشت و تفاوت قیمت به مشتری مربوط می‌شود.' ),
						array( 'q' => 'برای درخواست مرجوعی چه اطلاعاتی لازم است؟', 'a' => 'شماره فاکتور، شماره همراه خریدار، مدل و سایز، دلیل درخواست و چند عکس از کالا و بسته‌بندی. این اطلاعات را به واتساپ یا تلفن پشتیبانی بفرستید.' ),
					),
				),
			),
			'tracking' => array(
				'title' => 'پیگیری سفارش',
				'sub'   => 'با شماره سفارش و ایمیل ثبت‌شده در خرید، وضعیت سفارش خود را ببینید.',
				'note'  => 'شماره سفارش در پیام تأیید خرید و فاکتور آمده است.',
			),
			'warranty_steps' => array(
				array( 'n' => '۱', 't' => 'ثبت درخواست', 's' => 'تماس یا ارسال پیام با شماره فاکتور' ),
				array( 'n' => '۲', 't' => 'بررسی کارشناس', 's' => 'بازبینی عکس‌ها و سابقه خرید' ),
				array( 'n' => '۳', 't' => 'هماهنگی خدمات', 's' => 'تعیین زمان بازدید یا جایگزینی' ),
				array( 'n' => '۴', 't' => 'جمع‌بندی', 's' => 'اعلام نتیجه و انجام خدمات' ),
			),
			'cta' => array(
				'title' => 'پاسخ پرسشتان را پیدا نکردید؟',
				'sub'   => 'کارشناسان هیگر در ساعت کاری پاسخگوی شما هستند.',
			),
		);
	}
}

/* ============================================================ بخش ۲ — ابزارها */
if ( ! function_exists( 'higer_support_fa' ) ) {
	function higer_support_fa( $v ) {
		return strtr( (string) $v, array( '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹' ) );
	}
}
if ( ! function_exists( 'higer_support_icon' ) ) {
	function higer_support_icon( $n, $s = 18 ) {
		$p = array(
			'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
			'whatsapp' => '<path d="M3 21l1.7-3.9a9 9 0 1 1 3.4 2.9L3 21"/><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"/>',
			'telegram' => '<path d="M21 4 3 11l5 2 2 6 3-4 5 3z"/><path d="m8 13 9-6"/>',
			'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
			'truck'    => '<path d="M3 6h11v10H3z"/><path d="M14 10h4l3 3v3h-7"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/>',
			'card'     => '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>',
			'ruler'    => '<path d="M21 15 9 3 3 9l12 12z"/><path d="m8 6 2 2M11 9l2 2M5 12l2 2"/>',
			'shield'   => '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="m9 12 2 2 4-4"/>',
			'refresh'  => '<path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/><path d="M3 21v-5h5"/>',
			'chevron'  => '<path d="m6 9 6 6 6-6"/>',
			'arrow'    => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'bag'      => '<path d="M5 8h14l-1 13H6L5 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
			'search'   => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
			'instagram'=> '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>',
			'print'    => '<path d="M6 9V3h12v6"/><rect x="3" y="9" width="18" height="8" rx="2"/><path d="M7 17h10v4H7z"/>',
		);
		$path = isset( $p[ $n ] ) ? $p[ $n ] : '';
		return '<svg width="' . (int) $s . '" height="' . (int) $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* ============================================================ بخش ۳ — استایل و اسکریپت */
if ( ! function_exists( 'higer_support_assets' ) ) {
	function higer_support_assets() {
		static $done = false;
		if ( $done ) {
			return '';
		}
		$done = true;
		return <<<'HTML'
<style id="higer-support-css">
.higer-support{--hs-navy:#10243e;--hs-deep:#0b1a30;--hs-gold:#d9a13b;--hs-gold-l:#f3d98b;--hs-gold-p:#f8ead0;--hs-cream:#faf7ef;--hs-line:#e3ddcd;--hs-text:#2b4e77;display:block;background:var(--hs-cream);color:var(--hs-navy);font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;direction:rtl;text-align:right;font-size:15px;line-height:1.8;-webkit-font-smoothing:antialiased;border-radius:0}
.higer-support *,.higer-support *::before,.higer-support *::after{box-sizing:border-box}
.higer-support :is(h1,h2,h3,h4,p,ul,ol,li,dl,dd,figure){margin:0;padding:0;border:0}
.higer-support :is(h1,h2,h3,h4){font-family:inherit;font-weight:900;line-height:1.5;color:inherit}
.higer-support :is(ul,ol){list-style:none}
.higer-support a{color:inherit;text-decoration:none;background:none}
.higer-support button{font:inherit;color:inherit;background:none;border:0;padding:0;cursor:pointer;text-align:right}
.higer-support svg{display:block;flex:none}
.higer-support .hs-wrap{max-width:1180px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-support .hs-wrap{padding-inline:24px}}
.higer-support .hs-hero{position:relative;overflow:hidden;color:var(--hs-cream);padding-bottom:38px;background:radial-gradient(900px 420px at 85% -10%,rgba(217,161,59,.2),transparent 60%),radial-gradient(700px 380px at -10% 110%,rgba(43,78,119,.35),transparent 55%),linear-gradient(160deg,#0b1a30,#10243e 48%,#16304f)}
.higer-support .hs-hero::before{content:"";position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px}
.higer-support .hs-hero>*{position:relative}
.higer-support .hs-crumbs{margin-bottom:22px;border-bottom:1px solid rgba(243,217,139,.16)}
.higer-support .hs-crumbs ol{display:flex;flex-wrap:wrap;gap:6px;padding:12px 0;font-size:12px;font-weight:700;color:rgba(250,247,239,.72)}
.higer-support .hs-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-support .hs-crumbs li+li::before{content:"‹";color:var(--hs-gold-l);font-weight:900}
.higer-support .hs-kicker{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;border-radius:9999px;border:1px solid rgba(217,161,59,.4);background:rgba(7,15,29,.55);color:var(--hs-gold-l);font-size:11px;font-weight:800}
.higer-support .hs-title{margin-top:12px;font-size:28px;color:#fff}
@media(min-width:640px){.higer-support .hs-title{font-size:36px}}
.higer-support .hs-title span{background:linear-gradient(175deg,#f8ead0,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-support .hs-sub{max-width:640px;margin-top:10px;font-size:13px;line-height:2;color:rgba(248,234,208,.85)}
.higer-support .hs-hero-actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:22px}
.higer-support .hs-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 22px;border-radius:9999px;font-size:13px;font-weight:900;transition:transform .2s,filter .2s;border:1px solid transparent}
.higer-support .hs-btn.is-gold{background:linear-gradient(180deg,#ecc470,#d9a13b 55%,#c8892a);color:var(--hs-navy);box-shadow:0 12px 26px rgba(217,161,59,.32),inset 0 1px 0 rgba(255,255,255,.7)}
.higer-support .hs-btn.is-dark{border-color:rgba(243,217,139,.35);background:rgba(7,15,29,.45);color:var(--hs-gold-p)}
.higer-support .hs-btn:hover{transform:translateY(-2px);filter:brightness(1.05)}

/* تماس سریع */
.higer-support .hs-body{padding-block:30px 66px}
.higer-support .hs-channels{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;margin-top:-62px;position:relative;z-index:2}
.higer-support .hs-channel{display:flex;align-items:center;gap:12px;padding:16px;border:1px solid var(--hs-line);border-radius:20px;background:#fff;box-shadow:0 16px 36px rgba(16,36,62,.08);transition:transform .2s,border-color .2s}
.higer-support .hs-channel:hover{transform:translateY(-3px);border-color:var(--hs-gold)}
.higer-support .hs-channel-ico{display:grid;place-items:center;width:44px;height:44px;border-radius:14px;background:linear-gradient(160deg,#16304f,#0b1a30);color:var(--hs-gold-l);flex:none}
.higer-support .hs-channel b{display:block;font-size:13.5px;font-weight:900}
.higer-support .hs-channel span{display:block;font-size:11.5px;line-height:1.7;color:var(--hs-text)}

/* پیگیری + راهنما */
.higer-support .hs-top{display:grid;gap:18px;margin-top:26px}
@media(min-width:1024px){.higer-support .hs-top{grid-template-columns:1.1fr .9fr}}
.higer-support .hs-panel{border:1px solid var(--hs-line);border-radius:24px;background:#fff;padding:22px;box-shadow:0 18px 44px rgba(16,36,62,.05)}
.higer-support .hs-panel-head{display:flex;align-items:center;gap:10px;padding-bottom:14px;border-bottom:1px solid var(--hs-line);margin-bottom:16px}
.higer-support .hs-panel-head span{display:grid;place-items:center;width:38px;height:38px;border-radius:12px;background:rgba(217,161,59,.14);color:#c8892a;flex:none}
.higer-support .hs-panel-head h2{font-size:16.5px}
.higer-support .hs-panel p{font-size:12.5px;line-height:2;color:var(--hs-text)}
.higer-support .hs-form{margin-top:14px}
.higer-support .hs-form :is(input.input-text,.input-text,select){width:100%;min-height:46px;padding:10px 14px;border:1.5px solid #ddd3bd;border-radius:12px;background:#fdfcf8;font:inherit;font-size:13px;color:var(--hs-navy);outline:none}
.higer-support .hs-form :is(input,select):focus{border-color:var(--hs-gold);box-shadow:0 0 0 4px rgba(217,161,59,.15)}
.higer-support .hs-form button,.higer-support .hs-form input[type="submit"]{justify-content:center;width:100%;margin-top:10px;padding:12px 18px;border:0;border-radius:9999px;background:linear-gradient(180deg,#ecc470,#c8892a);color:var(--hs-navy);font-size:13px;font-weight:900;cursor:pointer}
.higer-support .hs-form :is(p,label){font-size:12px;font-weight:700;color:var(--hs-navy)}
.higer-support .hs-native-note{margin-top:10px;padding:10px 12px;border-radius:12px;background:#f5f1e6;font-size:11px;color:#6b6250}
.higer-support .hs-links{display:grid;gap:8px;margin-top:12px}
.higer-support .hs-link{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:11px 14px;border:1px solid var(--hs-line);border-radius:13px;background:var(--hs-cream);font-size:12.5px;font-weight:800;transition:border-color .2s,background .2s}
.higer-support .hs-link:hover{border-color:var(--hs-gold);background:#fff}
.higer-support .hs-link svg{color:#c8892a}

/* سؤالات متداول */
.higer-support .hs-faq{margin-top:34px}
.higer-support .hs-sec-head{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:12px;margin-bottom:16px}
.higer-support .hs-sec-head h2{font-size:22px}
.higer-support .hs-sec-head p{margin-top:6px;font-size:12.5px;color:var(--hs-text)}
.higer-support .hs-chips{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px}
.higer-support .hs-chip{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border:1px solid var(--hs-line);border-radius:9999px;background:#fff;font-size:11.5px;font-weight:800;color:var(--hs-navy);transition:all .2s}
.higer-support .hs-chip:hover{border-color:var(--hs-gold);background:var(--hs-gold-p)}
.higer-support .hs-faq-grid{display:grid;gap:14px}
@media(min-width:900px){.higer-support .hs-faq-grid{grid-template-columns:1fr 1fr}}
.higer-support .hs-group{border:1px solid var(--hs-line);border-radius:22px;background:#fff;padding:18px;box-shadow:0 14px 34px rgba(16,36,62,.05)}
.higer-support .hs-group-head{display:flex;align-items:center;gap:10px;margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid var(--hs-line)}
.higer-support .hs-group-head span{display:grid;place-items:center;width:36px;height:36px;border-radius:11px;background:var(--hs-navy);color:var(--hs-gold-l);flex:none}
.higer-support .hs-group-head h3{font-size:14.5px}
.higer-support details{border-bottom:1px dashed var(--hs-line);padding:2px 0}
.higer-support details:last-child{border-bottom:0}
.higer-support summary{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:12px 2px;cursor:pointer;font-size:12.5px;font-weight:800;line-height:1.8;list-style:none}
.higer-support summary::-webkit-details-marker{display:none}
.higer-support summary svg{color:#c8892a;transition:transform .2s;flex:none}
.higer-support details[open] summary svg{transform:rotate(180deg)}
.higer-support details p{padding:0 2px 14px;font-size:12px;line-height:2.05;color:var(--hs-text)}

/* مسیر گارانتی */
.higer-support .hs-warranty{margin-top:32px;padding:24px;border-radius:24px;border:1px solid rgba(243,217,139,.24);background:radial-gradient(420px 220px at 90% 0%,rgba(217,161,59,.16),transparent 70%),linear-gradient(165deg,#0b1a30,#10243e 60%,#142c4c);color:var(--hs-cream)}
.higer-support .hs-warranty h2{color:#fff;font-size:20px}
.higer-support .hs-warranty>p{margin-top:6px;font-size:12.5px;line-height:2;color:rgba(248,234,208,.78)}
.higer-support .hs-steps{display:grid;gap:10px;margin-top:18px}
@media(min-width:720px){.higer-support .hs-steps{grid-template-columns:repeat(4,1fr)}}
.higer-support .hs-step{padding:14px;border:1px solid rgba(243,217,139,.2);border-radius:16px;background:rgba(7,15,29,.4)}
.higer-support .hs-step-num{display:grid;place-items:center;width:28px;height:28px;margin-bottom:8px;border-radius:50%;background:rgba(217,161,59,.18);color:var(--hs-gold-l);font-size:11px;font-weight:900}
.higer-support .hs-step b{display:block;font-size:12.5px;font-weight:900;color:#fff}
.higer-support .hs-step span{display:block;margin-top:2px;font-size:11px;line-height:1.8;color:rgba(250,247,239,.68)}

/* CTA */
.higer-support .hs-cta{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px;margin-top:22px;padding:20px 24px;border-radius:22px;background:var(--hs-navy);color:var(--hs-cream)}
.higer-support .hs-cta b{display:block;font-size:16px;color:#fff}
.higer-support .hs-cta span{display:block;margin-top:2px;font-size:12px;color:rgba(250,247,239,.7)}
.higer-support .hs-cta-actions{display:flex;flex-wrap:wrap;gap:8px}
.higer-support .hs-cta .hs-btn{padding:10px 18px;font-size:12px}
@media(max-width:640px){.higer-support .hs-channels{margin-top:18px}.higer-support .hs-title{font-size:25px}}
</style>
<script id="higer-support-js">
(function(){document.addEventListener('click',function(e){
  var chip=e.target.closest('[data-hs-target]');
  if(!chip){return;}
  var el=document.getElementById(chip.getAttribute('data-hs-target'));
  if(!el){return;}
  e.preventDefault();
  if(el.tagName==='DETAILS'){el.setAttribute('open','open');}
  el.scrollIntoView({behavior:'smooth',block:'start'});
});})();
</script>
HTML;
	}
}

/* ============================================================ بخش ۴ — شورت‌کد */
if ( ! function_exists( 'higer_support_render' ) ) {
	function higer_support_render( $atts = array() ) {
		$atts = shortcode_atts( array( 'fullwidth' => 'yes', 'hero' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_support' );
		$cfg  = higer_support_config();
		$urls = $cfg['urls'];
		$st   = $cfg['store'];
		$hero = ! empty( $cfg['hero'] ) && 'no' !== strtolower( (string) $atts['hero'] );
		$fw   = 'no' !== strtolower( (string) $atts['fullwidth'] );

		$tracking_form = '';
		if ( function_exists( 'do_shortcode' ) && function_exists( 'shortcode_exists' ) && shortcode_exists( 'woocommerce_order_tracking' ) ) {
			$tracking_form = do_shortcode( '[woocommerce_order_tracking]' );
		}

		ob_start();
		echo higer_support_assets(); // phpcs:ignore
		?>
<div class="higer-support" id="higer-support" data-hs-fw="<?php echo $fw ? 'yes' : 'no'; ?>">
	<?php if ( $hero ) : ?>
	<section class="hs-hero">
		<div class="hs-wrap">
			<nav class="hs-crumbs" aria-label="مسیر صفحه">
				<ol>
					<li><a href="<?php echo esc_url( $urls['home'] ); ?>">خانه</a></li>
					<li aria-current="page">پشتیبانی مشتریان</li>
				</ol>
			</nav>
			<span class="hs-kicker"><?php echo higer_support_icon( 'shield', 12 ); // phpcs:ignore ?> راهنمای خرید و پاسخ سریع</span>
			<h1 class="hs-title"><?php echo esc_html( $cfg['hero']['title_a'] ); ?> <span><?php echo esc_html( $cfg['hero']['title_b'] ); ?></span></h1>
			<p class="hs-sub"><?php echo esc_html( $cfg['hero']['subtitle'] ); ?></p>
			<div class="hs-hero-actions">
				<a class="hs-btn is-gold" href="<?php echo esc_url( $st['tel'] ); ?>"><?php echo higer_support_icon( 'phone', 15 ); // phpcs:ignore ?> تماس با پشتیبانی<br class="hs-br"> <span dir="ltr"><?php echo esc_html( $st['phone_fa'] ); ?></span></a>
				<a class="hs-btn is-dark" href="<?php echo esc_url( $st['whatsapp'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo higer_support_icon( 'whatsapp', 15 ); // phpcs:ignore ?> گفتگو در واتساپ</a>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<div class="hs-body">
		<div class="hs-wrap">
			<div class="hs-channels">
				<?php foreach ( $cfg['channels'] as $ch ) :
					$href = 'tel' === $ch['url_key'] ? $st['tel'] : ( isset( $st[ $ch['url_key'] ] ) ? $st[ $ch['url_key'] ] : '' );
					$tag  = $href ? 'a' : 'div';
					?>
					<<?php echo $tag; ?><?php echo $href ? ' href="' . esc_url( $href ) . '"' . ( in_array( $ch['url_key'], array( 'whatsapp', 'telegram' ), true ) ? ' target="_blank" rel="noopener noreferrer"' : '' ) : ''; ?> class="hs-channel">
						<span class="hs-channel-ico"><?php echo higer_support_icon( $ch['icon'], 21 ); // phpcs:ignore ?></span>
						<div>
							<b><?php echo esc_html( $ch['title'] ); ?></b>
							<span dir="ltr"><?php echo esc_html( $ch['sub'] ); ?></span>
							<span><?php echo esc_html( $ch['desc'] ); ?></span>
						</div>
					</<?php echo $tag; ?>>
				<?php endforeach; ?>
			</div>

			<div class="hs-top">
				<section class="hs-panel" aria-labelledby="hs-track-title">
					<div class="hs-panel-head">
						<span><?php echo higer_support_icon( 'search', 19 ); // phpcs:ignore ?></span>
						<h2 id="hs-track-title"><?php echo esc_html( $cfg['tracking']['title'] ); ?></h2>
					</div>
					<p><?php echo esc_html( $cfg['tracking']['sub'] ); ?></p>
					<?php if ( $tracking_form ) : ?>
						<div class="hs-form hs-native"><?php echo $tracking_form; // phpcs:ignore ?></div>
						<p class="hs-native-note"><?php echo esc_html( $cfg['tracking']['note'] ); ?></p>
					<?php else : ?>
						<div class="hs-links">
							<a class="hs-link" href="<?php echo esc_url( $urls['account'] ); ?>"><span>ورود به حساب کاربری و مشاهده سفارش‌ها</span><?php echo higer_support_icon( 'arrow', 15 ); // phpcs:ignore ?></a>
							<a class="hs-link" href="<?php echo esc_url( $st['tel'] ); ?>"><span>پیگیری تلفنی با شماره فاکتور</span><?php echo higer_support_icon( 'arrow', 15 ); // phpcs:ignore ?></a>
						</div>
					<?php endif; ?>
				</section>

				<section class="hs-panel" aria-labelledby="hs-help-title">
					<div class="hs-panel-head">
						<span><?php echo higer_support_icon( 'bag', 19 ); // phpcs:ignore ?></span>
						<h2 id="hs-help-title">دسترسی سریع</h2>
					</div>
					<p>مسیرهای پرکاربرد برای خرید، پرداخت و خدمات پس از فروش.</p>
					<div class="hs-links">
						<a class="hs-link" href="<?php echo esc_url( $urls['shop'] ); ?>"><span>مشاهده محصولات و انتخاب سایز</span><?php echo higer_support_icon( 'arrow', 15 ); // phpcs:ignore ?></a>
						<a class="hs-link" href="<?php echo esc_url( $urls['cart'] ); ?>"><span>سبد خرید و ادامه سفارش</span><?php echo higer_support_icon( 'arrow', 15 ); // phpcs:ignore ?></a>
						<a class="hs-link" href="<?php echo esc_url( $urls['contact'] ); ?>"><span>فرم تماس و نشانی فروشگاه</span><?php echo higer_support_icon( 'arrow', 15 ); // phpcs:ignore ?></a>
					</div>
				</section>
			</div>

			<section class="hs-faq" aria-labelledby="hs-faq-title">
				<div class="hs-sec-head">
					<div>
						<h2 id="hs-faq-title">سؤالات متداول</h2>
						<p>دسته موردنظر را انتخاب کنید یا پاسخ‌ها را باز کنید.</p>
					</div>
				</div>
				<div class="hs-chips">
					<?php foreach ( $cfg['faq'] as $i => $group ) : ?>
						<button type="button" class="hs-chip" data-hs-target="hs-group-<?php echo (int) $i; ?>"><?php echo higer_support_icon( $group['icon'], 14 ); // phpcs:ignore ?> <?php echo esc_html( $group['title'] ); ?></button>
					<?php endforeach; ?>
				</div>
				<div class="hs-faq-grid">
					<?php foreach ( $cfg['faq'] as $i => $group ) : ?>
						<div class="hs-group" id="hs-group-<?php echo (int) $i; ?>">
							<div class="hs-group-head">
								<span><?php echo higer_support_icon( $group['icon'], 18 ); // phpcs:ignore ?></span>
								<h3><?php echo esc_html( $group['title'] ); ?></h3>
							</div>
							<?php foreach ( $group['items'] as $item ) : ?>
								<details>
									<summary><?php echo esc_html( $item['q'] ); ?> <?php echo higer_support_icon( 'chevron', 15 ); // phpcs:ignore ?></summary>
									<p><?php echo esc_html( $item['a'] ); ?></p>
								</details>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</section>

			<section class="hs-warranty" aria-labelledby="hs-warranty-title">
				<h2 id="hs-warranty-title">مسیر گارانتی و خدمات پس از فروش</h2>
				<p>برای اینکه درخواست شما سریع بررسی شود، این چهار قدم را دنبال کنید.</p>
				<div class="hs-steps">
					<?php foreach ( $cfg['warranty_steps'] as $step ) : ?>
						<div class="hs-step">
							<span class="hs-step-num"><?php echo esc_html( $step['n'] ); ?></span>
							<b><?php echo esc_html( $step['t'] ); ?></b>
							<span><?php echo esc_html( $step['s'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="hs-cta">
					<div>
						<b><?php echo esc_html( $cfg['cta']['title'] ); ?></b>
						<span><?php echo esc_html( $cfg['cta']['sub'] ); ?></span>
					</div>
					<div class="hs-cta-actions">
						<a class="hs-btn is-gold" href="<?php echo esc_url( $st['tel'] ); ?>"><?php echo higer_support_icon( 'phone', 14 ); // phpcs:ignore ?> <span dir="ltr"><?php echo esc_html( $st['phone_fa'] ); ?></span></a>
						<a class="hs-btn is-dark" href="<?php echo esc_url( $urls['contact'] ); ?>">فرم تماس</a>
					</div>
				</div>
				<p style="margin-top:14px;font-size:11.5px;color:rgba(250,247,239,.55)">ساعت پاسخگویی: <?php echo esc_html( $st['hours'] ); ?> · <?php echo esc_html( $st['address'] ); ?></p>
			</section>
		</div>
	</div>
</div>
		<?php
		return (string) ob_get_clean();
	}
}

/* ============================================================ بخش ۵ — ثبت و جایگزینی */
if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_support' ) ) {
	add_shortcode( 'higer_support', 'higer_support_render' );
}
if ( ! function_exists( 'higer_support_is_page' ) ) {
	function higer_support_is_page() {
		if ( ! function_exists( 'is_page' ) ) {
			return false;
		}
		return is_page( array( 'customer-support', 'support', 'پشتیبانی', 'پشتیبانی-مشتریان' ) );
	}
}
if ( ! function_exists( 'higer_support_auto_replace' ) ) {
	function higer_support_auto_replace( $content ) {
		$cfg = higer_support_config();
		if (
			empty( $cfg['auto_replace'] ) ||
			! function_exists( 'is_page' ) || ! higer_support_is_page() ||
			! in_the_loop() || ! is_main_query() ||
			( function_exists( 'has_shortcode' ) && has_shortcode( (string) $content, 'higer_support' ) )
		) {
			return $content;
		}
		return higer_support_render();
	}
}
if ( ! function_exists( 'higer_support_body_class' ) ) {
	function higer_support_body_class( $classes ) {
		if ( higer_support_is_page() ) {
			$classes[] = 'hs-body-page';
		}
		return $classes;
	}
}
if ( function_exists( 'add_filter' ) ) {
	add_filter( 'the_content', 'higer_support_auto_replace', 20 );
	add_filter( 'body_class', 'higer_support_body_class' );
}
