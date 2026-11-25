<?php
/**
 * Higer Legal — صفحه «قوانین و حریم خصوصی» تشک هیگر | نسخه بدون بیلد (v1)
 * =====================================================================
 * اسنیپت PHP مستقل برای WPCode، هم‌خانواده با Home.php، Checkout.php و فوتر هیگر.
 * دو سند را در یک صفحه با تب و فهرست کنار صفحه نمایش می‌دهد: قوانین و مقررات، حریم خصوصی.
 *
 * ─── نصب ───
 *  WPCode > PHP Snippet > کل فایل را Paste > Auto Insert / Run Everywhere > Activate
 *  در برگه «قوانین و حریم خصوصی» یک ویجت Shortcode بگذارید:  [higer_terms]
 *  یا 'auto_replace' را true کنید.
 *
 * ─── شورت‌کد ───
 *  [higer_terms]                    هر دو تب
 *  [higer_terms tab="terms"]        فقط قوانین
 *  [higer_terms tab="privacy"]      فقط حریم خصوصی
 *  [higer_terms hero="no"]          بدون سربرگ
 *
 * ─── هشدار مهم ───
 *  این متن‌ها «الگوی حرفه‌ای» برای فروشگاه تشک هستند و جایگزین مشاوره حقوقی نیستند.
 *  پیش از انتشار، بندهای مربوط به شرایط مرجوعی، گارانتی و مالیات را با مشاور حقوقی
 *  و شرایط واقعی فروشگاه تطبیق دهید.
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================ بخش ۱ — تنظیمات */
if ( ! function_exists( 'higer_legal_config' ) ) {
	function higer_legal_config() {
		$home = function_exists( 'home_url' ) ? home_url( '/' ) : 'https://higermattress.ir/';

		return array(
			'auto_replace' => false,
			'company' => array(
				'name'    => 'فروشگاه تشک هیگر',
				'address' => 'بابل، خیابان ولیعصر، خیابان نواب صفوی، نبش اشرفی ۲۷',
				'tel_fa'  => '۰۹۱۱۱۱۸۶۴۸۵',
				'tel'     => 'tel:+989111186485',
				'email'   => 'info@higermattress.ir',
				'updated' => '۱۴۰۴/۰۹/۰۱',
			),
			'urls' => array(
				'home'    => $home,
				'contact' => rtrim( $home, '/' ) . '/contact-us/',
				'support' => rtrim( $home, '/' ) . '/customer-support/',
				'shop'    => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : rtrim( $home, '/' ) . '/shop/',
			),
			'hero' => array(
				'kicker'   => 'شفافیت در خرید',
				'title_a'  => 'قوانین و',
				'title_b'  => 'حریم خصوصی',
				'subtitle' => 'شرایط خرید، ارسال، گارانتی و مرجوعی و همچنین نحوه نگهداری از اطلاعات شما در یک صفحه، به زبان ساده.',
			),
			'tabs' => array(
				'terms'   => 'قوانین و مقررات',
				'privacy' => 'حریم خصوصی',
			),
			/* --- قوانین و مقررات --- */
			'terms' => array(
				array( 'id' => 'terms-general', 'title' => '۱. پذیرش قوانین و دامنه کاربرد', 'body' => 'با ثبت سفارش در سایت تشک هیگر، شما تأیید می‌کنید که این قوانین را خوانده‌اید و می‌پذیرید. این قوانین برای خرید از این سایت و ارتباط با فروشگاه هیگر اعمال می‌شود. اگر با هر بخش از آن موافق نیستید، لطفاً پیش از ثبت سفارش با پشتیبانی تماس بگیرید.' ),
				array( 'id' => 'terms-product', 'title' => '۲. مشخصات محصول و نمایش رنگ', 'body' => 'مشخصات فنی، ابعاد، جنس و شرایط گارانتی هر تشک در صفحه همان محصول آمده است و مبنای سفارش است. ممکن است رنگ و بافت واقعی محصول در نمایشگرها کمی متفاوت دیده شود؛ این اختلاف طبیعی است و دلیل مرجوعی محسوب نمی‌شود. برای اطمینان از سایز یا مدل، پیش از خرید مشورت بگیرید.' ),
				array( 'id' => 'terms-order', 'title' => '۳. ثبت سفارش و تأیید نهایی', 'body' => 'سفارش پس از تکمیل اطلاعات، پرداخت و تأیید نهایی، ثبت‌شده تلقی می‌شود. فروشگاه ممکن است برای اطمینان از صحت نشانی، سایز و مشخصات با شما تماس بگیرد. اگر اطلاعات ناقص یا متناقض باشد، سفارش تا زمان تعیین تکلیف متوقف می‌شود.' ),
				array( 'id' => 'terms-price', 'title' => '۴. قیمت‌ها و تغییرات', 'body' => 'تمام قیمت‌ها به تومان و درج در سایت است. قیمت قابل پرداخت در صفحه تسویه حساب مرجع است. با توجه به نوسان بازار، فروشگاه حق دارد قیمت محصولات را برای سفارش‌های بعدی تغییر دهد؛ این تغییر روی سفارش‌های ثبت‌شده و پرداخته‌شده اثر ندارد.' ),
				array( 'id' => 'terms-payment', 'title' => '۵. پرداخت و فاکتور', 'body' => 'پرداخت آنلاین از طریق درگاه بانکی رسمی انجام می‌شود. در صورتی که درگاه فعال نباشد یا با هماهنگی پشتیبانی، پرداخت به‌صورت کارت‌به‌کارت انجام می‌گیرد. اطلاعات کارت شما توسط فروشگاه ذخیره نمی‌شود. فاکتور پس از ثبت سفارش صادر می‌شود و تاریخ فاکتور مبنای شروع گارانتی است.' ),
				array( 'id' => 'terms-shipping', 'title' => '۶. ارسال و تحویل', 'body' => 'هزینه و زمان ارسال بر اساس شهر مقصد، ابعاد و وزن سفارش در مرحله تسویه حساب یا هماهنگی تلفنی تعیین می‌شود. ارسال به شهرهای دیگر با باربری هماهنگ‌شده انجام می‌گیرد. مشتری موظف است نشانی، شماره تماس و شرایط دسترسی (طبقه، آسانسور) را دقیق وارد کند. تأخیرهای ناشی از تعطیلات، حوادث غیرمترقبه یا محدودیت‌های حمل‌ونقل از کنترل فروشگاه خارج است.' ),
				array( 'id' => 'terms-inspection', 'title' => '۷. بازرسی هنگام تحویل', 'body' => 'لطفاً هنگام تحویل، سالم بودن بسته‌بندی و مطابقت مدل و سایز را بررسی کنید. اگر بسته‌بندی آسیب آشکار دارد، پیش از امضای رسید موضوع را به تحویل‌دهنده و پشتیبانی اطلاع دهید. تأخیر در اعلام آسیب، بررسی مسئولیت را سخت می‌کند.' ),
				array( 'id' => 'terms-warranty', 'title' => '۸. گارانتی', 'body' => 'گارانتی از تاریخ ثبت فاکتور شروع می‌شود و مدت آن برای هر مدل در صفحه محصول مشخص شده است. گارانتی سالم‌بودن ساختار و رفع ایرادات تولیدی را پوشش می‌دهد. پارگی، سوخته‌شدگی، لکه، برش، تغییرات غیرمجاز، استفاده نادرست (مانند تخت با اندازه نامناسب یا خیس شدن) و فرسودگی طبیعی از گارانتی خارج است. تشخیص نهایی با کارشناس فروشگاه است.' ),
				array( 'id' => 'terms-returns', 'title' => '۹. مرجوعی و تعویض', 'body' => 'طبق ماده ۳۷ قانون تجارت الکترونیک، مشتری می‌تواند تا ۷ روز پس از دریافت کالا، بدون نیاز به دلیل، انصراف خود را اعلام کند؛ به‌شرط آن‌که کالا در بسته‌بندی اولیه باشد و شرایط آن تغییر نکرده باشد. برای کالای بهداشتی مانند تشک، اگر پلمب باز شده و کالا استفاده شده باشد، به دلیل مسائل بهداشتی امکان مرجوعی محدود است. کالای سفارشی‌دوخت نیز معمولاً مرجوعی ندارد. هزینه رفت‌وبرگشت و تفاوت قیمت در تعویض، بر عهده مشتری است مگر ایراد از فروشگاه باشد.' ),
				array( 'id' => 'terms-custom', 'title' => '۱۰. سفارش دوخت سفارشی', 'body' => 'دوخت سفارشی بر اساس ابعاد اعلام‌شده مشتری انجام می‌شود. مسئولیت صحت اندازه‌ها و امکان ورود کالا به محل (پله، آسانسور، در) بر عهده مشتری است. سفارش دوخت سفارشی پس از تأیید نهایی، قابل لغو یا تعویض نیست مگر ایراد تولیدی داشته باشد.' ),
				array( 'id' => 'terms-ip', 'title' => '۱۱. مالکیت معنوی', 'body' => 'نام، لوگو، عکس‌ها و متن‌های سایت هیگر متعلق به این فروشگاه است و استفاده تجاری یا بازنشر بدون اجازه کتبی مجاز نیست.' ),
				array( 'id' => 'terms-changes', 'title' => '۱۲. تغییر قوانین و حل اختلاف', 'body' => 'فروشگاه می‌تواند این قوانین را به‌روزرسانی کند؛ نسخه معتبر همان است که در این صفحه منتشر می‌شود. برای هر اختلاف، ابتدا از مسیر پشتیبانی پیگیری کنید. در صورت نیاز، رسیدگی از طریق مراجع قانونی جمهوری اسلامی ایران و مطابق قوانین تجارت الکترونیک انجام می‌شود.' ),
			),
			/* --- حریم خصوصی --- */
			'privacy' => array(
				array( 'id' => 'privacy-scope', 'title' => '۱. چه اطلاعاتی از شما نگه می‌داریم؟', 'body' => 'برای انجام سفارش، اطلاعاتی مثل نام و نام خانوادگی، شماره همراه، نشانی تحویل، کد پستی، ایمیل (اختیاری)، محتوای سفارش و یادداشت تحویل را نگه می‌داریم. اطلاعات پرداخت مستقیماً در درگاه بانکی وارد می‌شود و فروشگاه شماره کارت و رمز شما را ذخیره نمی‌کند.' ),
				array( 'id' => 'privacy-purpose', 'title' => '۲. چرا این اطلاعات را جمع می‌کنیم؟', 'body' => 'برای پردازش و ارسال سفارش، هماهنگی تحویل، صدور فاکتور، پاسخ به درخواست‌های پشتیبانی، مدیریت گارانتی و مرجوعی، و رعایت تکالیف قانونی. اطلاعات برای بازاریابی استفاده نمی‌شود مگر با رضایت شما.' ),
				array( 'id' => 'privacy-legal', 'title' => '۳. مبنای قانونی و رضایت', 'body' => 'پردازش اطلاعات برای اجرای قرارداد خرید، انجام تکالیف قانونی و رضایت شما انجام می‌شود. با ثبت سفارش، پردازش اطلاعات لازم برای همان سفارش را می‌پذیرید. برای ارسال پیام‌های تبلیغاتی، امکان انصراف وجود دارد.' ),
				array( 'id' => 'privacy-cookies', 'title' => '۴. کوکی‌ها و ابزارهای اندازه‌گیری', 'body' => 'برای نگه‌داشتن سبد خرید، ورود به حساب و بهبود تجربه خرید از کوکی استفاده می‌شود. ممکن است از ابزارهای تحلیل بازدید برای بررسی عملکرد صفحات استفاده کنیم؛ این داده‌ها معمولاً تجمیعی هستند. می‌توانید کوکی‌ها را از تنظیمات مرورگر مدیریت کنید، اما بخشی از خرید و سبد ممکن است درست کار نکند.' ),
				array( 'id' => 'privacy-share', 'title' => '۵. اشتراک‌گذاری با دیگران', 'body' => 'اطلاعات لازم برای ارسال در اختیار شرکت حمل، و اطلاعات لازم برای پرداخت در اختیار درگاه بانکی قرار می‌گیرد. در صورت نیاز به خدمات نصب یا گارانتی، اطلاعات تماس با شرکت خدماتی مجاز به اشتراک گذاشته می‌شود. فروشگاه اطلاعات را به دیگران نمی‌فروشد و جز در تکالیف قانونی یا دستور مرجع صالح، در اختیار شخص ثالث قرار نمی‌دهد.' ),
				array( 'id' => 'privacy-retention', 'title' => '۶. مدت نگه‌داری', 'body' => 'اطلاعات سفارش به‌مدت لازم برای پیگیری گارانتی، مرجوعی و تکالیف حسابداری و مالیاتی نگه‌داری می‌شود. پس از پایان این مدت، اطلاعات حذف یا به‌صورت غیرقابل‌شناسایی نگه‌داری می‌شود.' ),
				array( 'id' => 'privacy-rights', 'title' => '۷. حقوق شما', 'body' => 'می‌توانید بخواهید اطلاعات حسابتان دیده، اصلاح یا در چارچوب قانون حذف شود. اگر حسابی در سایت ندارید، با شماره فاکتور و شماره همراه خرید، درخواست خود را از مسیر پشتیبانی ثبت کنید. به دلایل قانونی یا گارانتی، ممکن است برخی اطلاعات به‌مدت مشخصی قابل حذف نباشد.' ),
				array( 'id' => 'privacy-security', 'title' => '۸. امنیت اطلاعات', 'body' => 'دسترسی به اطلاعات سفارش محدود به کارکنان و سرویس‌های مرتبط است. ارتباط با سایت از طریق HTTPS انجام می‌شود. با این حال هیچ سامانه‌ای صددرصد ایمن نیست؛ برای کاهش خطر، از رمز عبور قوی استفاده کنید و اطلاعات کارت بانکی را در پیام‌رسان یا تلفن اعلام نکنید.' ),
				array( 'id' => 'privacy-children', 'title' => '۹. کاربران زیر سن قانونی', 'body' => 'خرید و ثبت اطلاعات شخصی باید توسط شخص بالغ یا با سرپرستی قانونی انجام شود. اگر اطلاعاتی از کودک زیر سن قانونی بدون سرپرست ثبت شده باشد، با اطلاع ما بررسی و حذف می‌شود.' ),
				array( 'id' => 'privacy-changes', 'title' => '۱۰. تغییر این سیاست و تماس', 'body' => 'در صورت تغییر شیوه نگه‌داری از اطلاعات، این صفحه به‌روزرسانی می‌شود و تاریخ آخرین ویرایش تغییر می‌کند. برای هر درباره حریم خصوصی، از شماره تماس یا فرم تماس سایت با ما در ارتباط باشید.' ),
			),
		);
	}
}

/* ============================================================ بخش ۲ — ابزارها */
if ( ! function_exists( 'higer_legal_icon' ) ) {
	function higer_legal_icon( $n, $s = 18 ) {
		$p = array(
			'doc'      => '<path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5"/><path d="M9 12h7M9 16h5"/>',
			'shield'   => '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="m9 12 2 2 4-4"/>',
			'print'    => '<path d="M6 9V3h12v6"/><rect x="3" y="9" width="18" height="8" rx="2"/><path d="M7 17h10v4H7z"/>',
			'phone'    => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/>',
			'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
			'pin'      => '<path d="M12 21s-7-6-7-11a7 7 0 0 1 14 0c0 5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/>',
			'arrow'    => '<path d="M19 12H5"/><path d="m11 18-6-6 6-6"/>',
			'chevron'  => '<path d="m6 9 6 6 6-6"/>',
			'check'    => '<path d="m5 12.5 4.5 4.5L19 6.5"/>',
			'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		);
		$path = isset( $p[ $n ] ) ? $p[ $n ] : '';
		return '<svg width="' . (int) $s . '" height="' . (int) $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
	}
}

/* ============================================================ بخش ۳ — استایل و اسکریپت */
if ( ! function_exists( 'higer_legal_assets' ) ) {
	function higer_legal_assets() {
		static $done = false;
		if ( $done ) {
			return '';
		}
		$done = true;
		return <<<'HTML'
<style id="higer-legal-css">
.higer-legal{--hl-navy:#10243e;--hl-deep:#0b1a30;--hl-gold:#d9a13b;--hl-gold-l:#f3d98b;--hl-gold-p:#f8ead0;--hl-cream:#faf7ef;--hl-line:#e3ddcd;--hl-text:#3f566f;display:block;background:var(--hl-cream);color:var(--hl-navy);font-family:"IRANSans","Vazirmatn","Segoe UI",Tahoma,sans-serif;direction:rtl;text-align:right;font-size:15px;line-height:1.9;-webkit-font-smoothing:antialiased}
.higer-legal *,.higer-legal *::before,.higer-legal *::after{box-sizing:border-box}
.higer-legal :is(h1,h2,h3,h4,p,ul,ol,li){margin:0;padding:0;border:0}
.higer-legal :is(h1,h2,h3,h4){font-family:inherit;font-weight:900;line-height:1.55;color:inherit}
.higer-legal :is(ul,ol){list-style:none}
.higer-legal a{color:inherit;text-decoration:none}
.higer-legal button{font:inherit;color:inherit;background:none;border:0;padding:0;cursor:pointer;text-align:right}
.higer-legal svg{display:block;flex:none}
.higer-legal .hl-wrap{max-width:1180px;margin-inline:auto;padding-inline:16px}
@media(min-width:640px){.higer-legal .hl-wrap{padding-inline:24px}}
.higer-legal .hl-hero{position:relative;overflow:hidden;color:var(--hl-cream);padding-bottom:38px;background:radial-gradient(900px 420px at 85% -10%,rgba(217,161,59,.2),transparent 60%),linear-gradient(160deg,#0b1a30,#10243e 50%,#16304f)}
.higer-legal .hl-hero::before{content:"";position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(243,217,139,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(243,217,139,.045) 1px,transparent 1px);background-size:44px 44px}
.higer-legal .hl-hero>*{position:relative}
.higer-legal .hl-crumbs{margin-bottom:22px;border-bottom:1px solid rgba(243,217,139,.16)}
.higer-legal .hl-crumbs ol{display:flex;flex-wrap:wrap;gap:6px;padding:12px 0;font-size:12px;font-weight:700;color:rgba(250,247,239,.72)}
.higer-legal .hl-crumbs li{display:inline-flex;align-items:center;gap:6px}
.higer-legal .hl-crumbs li+li::before{content:"‹";color:var(--hl-gold-l);font-weight:900}
.higer-legal .hl-kicker{display:inline-flex;align-items:center;gap:6px;padding:5px 14px;border-radius:9999px;border:1px solid rgba(217,161,59,.4);background:rgba(7,15,29,.55);color:var(--hl-gold-l);font-size:11px;font-weight:800}
.higer-legal .hl-title{margin-top:12px;font-size:28px;color:#fff}
@media(min-width:640px){.higer-legal .hl-title{font-size:36px}}
.higer-legal .hl-title span{background:linear-gradient(175deg,#f8ead0,#e7b95c 35%,#d9a13b 52%,#a86f1c 78%,#e7b95c);-webkit-background-clip:text;background-clip:text;color:transparent}
.higer-legal .hl-sub{max-width:640px;margin-top:10px;font-size:13px;line-height:2;color:rgba(248,234,208,.85)}
.higer-legal .hl-updated{display:inline-flex;align-items:center;gap:6px;margin-top:16px;padding:6px 12px;border-radius:8px;background:rgba(7,15,29,.45);border:1px solid rgba(243,217,139,.2);font-size:11px;font-weight:700;color:rgba(250,247,239,.8)}
.higer-legal .hl-body{padding-block:28px 64px}
.higer-legal .hl-layout{display:grid;gap:22px;align-items:start}
@media(min-width:1000px){.higer-legal .hl-layout{grid-template-columns:minmax(0,1fr) 268px}}
.higer-legal .hl-card{border:1px solid var(--hl-line);border-radius:26px;background:#fff;padding:24px;box-shadow:0 20px 50px rgba(16,36,62,.06)}
@media(min-width:640px){.higer-legal .hl-card{padding:30px}}
.higer-legal .hl-tabs{display:flex;flex-wrap:wrap;gap:6px;padding:5px;border:1px solid var(--hl-line);border-radius:15px;background:var(--hl-cream);margin-bottom:22px}
.higer-legal .hl-tab{flex:1;min-width:150px;display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:11px 14px;border-radius:11px;font-size:12.5px;font-weight:900;color:var(--hl-text);transition:background .2s,color .2s,box-shadow .2s}
.higer-legal .hl-tab[aria-selected="true"]{background:var(--hl-navy);color:var(--hl-gold-l);box-shadow:0 8px 18px rgba(16,36,62,.18)}
.higer-legal .hl-panel[hidden]{display:none!important}
.higer-legal .hl-panel-head{margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid var(--hl-line)}
.higer-legal .hl-panel-head h2{font-size:20px}
.higer-legal .hl-panel-head p{margin-top:6px;font-size:12px;line-height:1.95;color:var(--hl-text)}
.higer-legal .hl-sec{padding:18px 0;border-bottom:1px dashed var(--hl-line);scroll-margin-top:110px}
.higer-legal .hl-sec:last-of-type{border-bottom:0}
.higer-legal .hl-sec h3{display:flex;align-items:flex-start;gap:9px;font-size:15px;color:var(--hl-navy);cursor:pointer}
.higer-legal .hl-sec h3::before{content:"";width:8px;height:8px;margin-top:10px;border-radius:2px;background:var(--hl-gold);flex:none;transform:rotate(45deg)}
.higer-legal .hl-sec p{margin-top:10px;font-size:13px;line-height:2.15;color:var(--hl-text);text-align:justify}
.higer-legal .hl-sec .hl-tags{display:flex;flex-wrap:wrap;gap:6px;margin-top:10px}
.higer-legal .hl-sec .hl-tag{padding:4px 10px;border-radius:7px;background:var(--hl-gold-p);border:1px solid rgba(217,161,59,.35);font-size:10.5px;font-weight:800;color:#8a6a2a}
.higer-legal .hl-contact{margin-top:22px;padding:18px;border-radius:18px;border:1px solid var(--hl-line);background:var(--hl-cream)}
.higer-legal .hl-contact b{display:block;font-size:13.5px;margin-bottom:8px}
.higer-legal .hl-contact-list{display:grid;gap:6px;font-size:12px;color:var(--hl-text)}
.higer-legal .hl-contact-list li{display:flex;align-items:center;gap:8px}
.higer-legal .hl-contact-list svg{color:#c8892a}
.higer-legal .hl-contact-list a{font-weight:800;color:var(--hl-navy)}
.higer-legal .hl-note{margin-top:16px;padding:12px 14px;border-radius:12px;border:1px solid rgba(185,28,28,.2);background:#fff7ed;font-size:11px;line-height:1.95;color:#7c4a12}
.higer-legal .hl-side{display:grid;gap:14px}
@media(min-width:1000px){.higer-legal .hl-side{position:sticky;top:96px}}
.higer-legal .hl-toc{border:1px solid var(--hl-line);border-radius:20px;background:#fff;padding:16px;box-shadow:0 14px 34px rgba(16,36,62,.05)}
.higer-legal .hl-toc-title{display:flex;align-items:center;gap:7px;padding-bottom:10px;margin-bottom:8px;border-bottom:1px solid var(--hl-line);font-size:12px;font-weight:900;color:var(--hl-navy)}
.higer-legal .hl-toc-title svg{color:#c8892a}
.higer-legal .hl-toc nav{display:grid;gap:2px;max-height:420px;overflow:auto;padding-inline-end:2px}
.higer-legal .hl-toc a{display:block;padding:7px 9px;border-radius:8px;font-size:11.5px;line-height:1.7;color:#53667c;border-inline-start:2px solid transparent;transition:all .2s}
.higer-legal .hl-toc a:hover{background:var(--hl-cream);color:var(--hl-navy);border-inline-start-color:var(--hl-gold)}
.higer-legal .hl-toc a.is-active{background:var(--hl-gold-p);color:var(--hl-navy);border-inline-start-color:var(--hl-gold);font-weight:800}
.higer-legal .hl-side-card{border:1px solid var(--hl-line);border-radius:18px;background:#fff;padding:16px}
.higer-legal .hl-side-card b{display:block;font-size:12.5px;margin-bottom:8px}
.higer-legal .hl-side-card p{font-size:11.5px;line-height:1.95;color:var(--hl-text)}
.higer-legal .hl-side-card .hl-btn{display:flex;align-items:center;justify-content:center;gap:7px;width:100%;margin-top:10px;padding:11px 14px;border-radius:9999px;background:var(--hl-navy);color:var(--hl-gold-l);font-size:12px;font-weight:900;transition:transform .2s}
.higer-legal .hl-side-card .hl-btn:hover{transform:translateY(-2px)}
.higer-legal .hl-side-card .hl-btn.is-ghost{background:#fff;border:1px solid var(--hl-line);color:var(--hl-navy);font-weight:800}
.higer-legal .hl-side-card .hl-btn.is-gold{background:linear-gradient(180deg,#ecc470,#c8892a);color:var(--hl-navy)}
.higer-legal .hl-foot-note{margin-top:20px;padding:16px 18px;border-radius:16px;background:var(--hl-navy);color:rgba(250,247,239,.85);font-size:11.5px;line-height:2}
.higer-legal .hl-foot-note a{color:var(--hl-gold-l);font-weight:800}
@media print{
  .higer-legal .hl-hero{display:none}
  .higer-legal .hl-side,.higer-legal .hl-tabs,.higer-legal .hl-foot-note{display:none!important}
  .higer-legal .hl-card{box-shadow:none;border:0;padding:0}
  .higer-legal .hl-panel[hidden]{display:block!important}
  .higer-legal{background:#fff}
}
</style>
<script id="higer-legal-js">
(function(){
  var root=document.querySelector('.higer-legal');
  if(!root){return;}
  var tabs=root.querySelectorAll('[data-hl-tab]');
  var panels=root.querySelectorAll('[data-hl-panel]');
  function activate(name,scroll){
    tabs.forEach(function(t){t.setAttribute('aria-selected',t.getAttribute('data-hl-tab')===name?'true':'false');});
    panels.forEach(function(p){p.hidden=p.getAttribute('data-hl-panel')!==name;});
    buildToc(name);
    if(scroll){root.scrollIntoView({behavior:'smooth',block:'start'});}
  }
  tabs.forEach(function(t){t.addEventListener('click',function(){activate(t.getAttribute('data-hl-tab'),false);});});
  var toc=root.querySelector('[data-hl-toc]');
  var list=root.querySelector('[data-hl-toc-list]');
  function buildToc(name){
    if(!toc||!list){return;}
    var panel=root.querySelector('[data-hl-panel="'+name+'"]');
    if(!panel){return;}
    list.innerHTML='';
    panel.querySelectorAll('.hl-sec').forEach(function(sec){
      var h=sec.querySelector('h3');
      if(!h){return;}
      var a=document.createElement('a');
      a.href='#'+sec.id;
      a.textContent=h.textContent.trim();
      a.addEventListener('click',function(e){
        e.preventDefault();
        sec.scrollIntoView({behavior:'smooth',block:'start'});
        root.querySelectorAll('[data-hl-toc-list] a').forEach(function(x){x.classList.remove('is-active');});
        a.classList.add('is-active');
      });
      list.appendChild(a);
    });
  }
  var first=root.querySelector('[data-hl-tab][aria-selected="true"]');
  buildToc(first?first.getAttribute('data-hl-tab'):'terms');
  var print=root.querySelector('[data-hl-print]');
  if(print){print.addEventListener('click',function(){window.print();});}
})();
</script>
HTML;
	}
}

/* ============================================================ بخش ۴ — شورت‌کد */
if ( ! function_exists( 'higer_legal_render' ) ) {
	function higer_legal_render( $atts = array() ) {
		$atts = shortcode_atts( array( 'tab' => 'terms', 'hero' => 'yes', 'fullwidth' => 'yes' ), is_array( $atts ) ? $atts : array(), 'higer_terms' );
		$cfg  = higer_legal_config();
		$co   = $cfg['company'];
		$urls = $cfg['urls'];
		$tab  = in_array( $atts['tab'], array( 'terms', 'privacy' ), true ) ? $atts['tab'] : 'terms';
		$hero = 'no' !== strtolower( (string) $atts['hero'] );
		$fw   = 'no' !== strtolower( (string) $atts['fullwidth'] );

		ob_start();
		echo higer_legal_assets(); // phpcs:ignore
		?>
<div class="higer-legal" id="higer-legal" data-hl-fw="<?php echo $fw ? 'yes' : 'no'; ?>">
	<?php if ( $hero ) : ?>
	<section class="hl-hero">
		<div class="hl-wrap">
			<nav class="hl-crumbs" aria-label="مسیر صفحه">
				<ol>
					<li><a href="<?php echo esc_url( $urls['home'] ); ?>">خانه</a></li>
					<li aria-current="page">قوانین و حریم خصوصی</li>
				</ol>
			</nav>
			<span class="hl-kicker"><?php echo higer_legal_icon( 'shield', 12 ); // phpcs:ignore ?> شفافیت در خرید</span>
			<h1 class="hl-title"><?php echo esc_html( $cfg['hero']['title_a'] ); ?> <span><?php echo esc_html( $cfg['hero']['title_b'] ); ?></span></h1>
			<p class="hl-sub"><?php echo esc_html( $cfg['hero']['subtitle'] ); ?></p>
			<span class="hl-updated"><?php echo higer_legal_icon( 'clock', 12 ); // phpcs:ignore ?> آخرین به‌روزرسانی: <?php echo esc_html( $co['updated'] ); ?></span>
		</div>
	</section>
	<?php endif; ?>

	<div class="hl-body">
		<div class="hl-wrap hl-layout">
			<main class="hl-card">
				<div class="hl-tabs" role="tablist" aria-label="اسناد">
					<?php foreach ( $cfg['tabs'] as $key => $label ) : ?>
						<button type="button" class="hl-tab" role="tab" data-hl-tab="<?php echo esc_attr( $key ); ?>" aria-selected="<?php echo $tab === $key ? 'true' : 'false'; ?>"><?php echo higer_legal_icon( 'terms' === $key ? 'doc' : 'shield', 15 ); // phpcs:ignore ?> <?php echo esc_html( $label ); ?></button>
					<?php endforeach; ?>
				</div>

				<?php foreach ( $cfg['tabs'] as $key => $label ) : ?>
					<section class="hl-panel" role="tabpanel" data-hl-panel="<?php echo esc_attr( $key ); ?>" <?php echo $tab === $key ? '' : 'hidden'; ?>>
						<div class="hl-panel-head">
							<h2><?php echo esc_html( $label ); ?></h2>
							<p><?php echo 'terms' === $key ? 'شرایط خرید، پرداخت، ارسال، گارانتی و مرجوعی در فروشگاه تشک هیگر.' : 'شیوه جمع‌آوری، استفاده و نگهداری از اطلاعات شخصی شما.'; ?></p>
						</div>
						<?php foreach ( $cfg[ $key ] as $sec ) : ?>
							<article class="hl-sec" id="<?php echo esc_attr( $sec['id'] ); ?>">
								<h3><?php echo esc_html( $sec['title'] ); ?></h3>
								<p><?php echo esc_html( $sec['body'] ); ?></p>
							</article>
						<?php endforeach; ?>
						<div class="hl-contact">
							<b>سؤال یا درخواست دارید؟</b>
							<ul class="hl-contact-list">
								<li><?php echo higer_legal_icon( 'phone', 14 ); // phpcs:ignore ?> <a href="<?php echo esc_url( $co['tel'] ); ?>" dir="ltr"><?php echo esc_html( $co['tel_fa'] ); ?></a></li>
								<li><?php echo higer_legal_icon( 'pin', 14 ); // phpcs:ignore ?> <span><?php echo esc_html( $co['address'] ); ?></span></li>
								<li><?php echo higer_legal_icon( 'mail', 14 ); // phpcs:ignore ?> <a href="mailto:<?php echo esc_attr( $co['email'] ); ?>" dir="ltr"><?php echo esc_html( $co['email'] ); ?></a></li>
							</ul>
						</div>
						<p class="hl-note"><strong>یادآوری:</strong> این متن به‌عنوان الگوی شفاف‌سازی شرایط فروشگاه تهیه شده است و جایگزین مشاوره حقوقی نیست. بندهای مربوط به مرجوعی، گارانتی و مالیات را با شرایط واقعی فروشگاه و مشاور حقوقی تطبیق دهید.</p>
					</section>
				<?php endforeach; ?>

				<div class="hl-foot-note">
					صفحه پشتیبانی: <a href="<?php echo esc_url( $urls['support'] ); ?>">پاسخ سؤالات متداول و راه‌های تماس</a> · برای خرید: <a href="<?php echo esc_url( $urls['shop'] ); ?>">مشاهده محصولات هیگر</a>
				</div>
			</main>

			<aside class="hl-side">
				<div class="hl-toc">
					<div class="hl-toc-title"><?php echo higer_legal_icon( 'doc', 14 ); // phpcs:ignore ?> فهرست این سند</div>
					<nav data-hl-toc><div data-hl-toc-list></div></nav>
				</div>
				<div class="hl-side-card">
					<b>نسخه قابل چاپ</b>
					<p>برای نگهداری یا ارائه به پشتیبانی، نسخه چاپی این سند را بگیرید.</p>
					<button type="button" class="hl-btn is-ghost" data-hl-print><?php echo higer_legal_icon( 'print', 14 ); // phpcs:ignore ?> چاپ / ذخیره PDF</button>
					<a class="hl-btn is-gold" href="<?php echo esc_url( $co['tel'] ); ?>"><?php echo higer_legal_icon( 'phone', 14 ); // phpcs:ignore ?> تماس با فروشگاه</a>
				</div>
				<div class="hl-side-card">
					<b>پیش از خرید بخوانید</b>
					<p>سایز و مدل را با ابعاد تخت خود مقایسه کنید. برای کالای بهداشتی مانند تشک، باز کردن پلمب شرایط مرجوعی را محدود می‌کند.</p>
					<a class="hl-btn" href="<?php echo esc_url( $urls['support'] ); ?>">راهنمای خرید و پشتیبانی</a>
				</div>
			</aside>
		</div>
	</div>
</div>
		<?php
		return (string) ob_get_clean();
	}
}

/* ============================================================ بخش ۵ — ثبت و جایگزینی */
if ( function_exists( 'add_shortcode' ) && ! shortcode_exists( 'higer_terms' ) ) {
	add_shortcode( 'higer_terms', 'higer_legal_render' );
}
if ( ! function_exists( 'higer_legal_is_page' ) ) {
	function higer_legal_is_page() {
		if ( ! function_exists( 'is_page' ) ) {
			return false;
		}
		return is_page( array( 'terms-and-privacy', 'terms', 'privacy', 'terms-privacy', 'قوانین-و-حریم-خصوصی' ) );
	}
}
if ( ! function_exists( 'higer_legal_auto_replace' ) ) {
	function higer_legal_auto_replace( $content ) {
		$cfg = higer_legal_config();
		if (
			empty( $cfg['auto_replace'] ) ||
			! higer_legal_is_page() ||
			! in_the_loop() || ! is_main_query() ||
			( function_exists( 'has_shortcode' ) && has_shortcode( (string) $content, 'higer_terms' ) )
		) {
			return $content;
		}
		return higer_legal_render();
	}
}
if ( function_exists( 'add_filter' ) ) {
	add_filter( 'the_content', 'higer_legal_auto_replace', 20 );
}
