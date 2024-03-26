<!doctype html>
<html dir="rtl" lang="fa-IR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="numerical-analysis.css">
    <script src="numerical-analysis.js"></script>
</head>
<body style="direction: rtl;">
    <div class="header"><video width="80" height="80" autoplay loop muted><source src="https://rezasadid.com/files/data/rs-logo-long.mp4" type="video/mp4" />Reza Sadid</video></div>
    <div class="page"><a class="button fa back" href="https://rezasadid.com/projects/numericalanalysis/">→ بازگشت به فهرست</a><div>
        <h1 class="fa">ریشه یابی - روش نیوتون</h1>
        <p>
            با وارد کردن تابع مورد نظر و مشتق آن در فرم زیر، یکی از ریشه‌های آن با استفاده از روش دوبخشی با توجه به مقدار تخمینی اولیه وارد شده محاسبه میشود. تکرارها تا زمانی که 7 رقم بامعنا پاسخ ثابت بماند ادامه می‌یابد و در نهایت ریشه تابع با تقریب بدست می‌آید. در صورت تمایل می‌توانید تابع دلخواه خود را در فرم وارد کنید یا با کلیک بر روی دکمه پایین فرم، از یک تابع پیش‌فرض برای محاسبات استفاده کنید.
        </p>
        <div class="message">برای مشاهده پاسخ اسکرول کنید</div>
        <form id="mainform" method="post" action="">
            <div class="inp">
                <input type="text" name="function" id="v1">
                <label onclick="focusinp('v1')" for="v1">تابع</label>
            </div>
            <div class="inp">
                <input type="text" name="functionderivative" id="v2">
                <label onclick="focusinp('v2')" for="v2">مشتق تابع</label>
            </div>
            <div class="inp">
                <input type="text" name="initial" id="v3">
                <label onclick="focusinp('v3')" for="v3">تخمین اولیه</label>
            </div>
            <button type="submit">ثبت</button>
        </form>
        <div class="separator"><div class="line"></div><p>یا</p><div class="line"></div></div>
        <button type="button" onclick="methodnewtonraphson()">محاسبه ریشه تابع <code>(2x+5)*sin(x)+5</code> با تخمین اولیه 3</button>
        <div class="note"><span>↵</span>
            مشق تابع پیشفرض برابر با 
            <code>(2*sin(x))+((2*x+5)*cos(x))</code>
             در نظر گرفته شده است
        </div>
        <div class="help">
            <span>راهنما</span>
            در وارد کردن تابع توجه کنید که برای اپراتور جمع از + و برای اپراتور تفریق از - و برای اپراتور ضرب از * و برای اپراتور تقسیم از / و برای اپراتور توان از ** استفاده نمائید، همچنین میتواند از توابع مثلثاتی مانند سینوس و کسینوس و تانژانت و سینوس هیپربولیک و کسینوس هیپربولیک نیز استفاده کنید که به ترتیب در قالب 
            <code>sin(تابع مدنظر)</code>
            و 
            <code>cos(تابع مدنظر)</code>
            و 
            <code>tan(تابع مدنظر)</code>
            و 
            <code>sinh(تابع مدنظر)</code>
            و 
            <code>cosh(تابع مدنظر)</code>
            باید وارد شوند. برای وارد کردن رادیکال از قالب 
            <code>sqrt(تابع مدنظر)</code>
            و برای لگاریتم از قالب 
            <code>log(تابع مدنظر,پایه لگاریتم)</code>
            استفاده نمائید. در وارد کردن تابع توجه نمائید که اپراتور ضرب را حتما بین ارقام و متغیر ها درج نمائید برای مثال بجای عبارت 
            <code>2x</code>
            یا 
            <code>2sin(x)</code>
            باید 
            <code>2*x</code>
            یا 
            <code>2*sin(x)</code>
            نوشته شود تا تابع پس از ترجمه مطابق با سینتکس پی اچ پی باشد. درصورتی که پس از ثبت تابع روند تکرار نمایش داده نشد تابع خود را تصحیح کنید و یا از دکمه پایین آن استفاده نمائید که بمنظور سهولت روند تست تابعی پیشفرض با کلیک بر روی آن در فرم قرار میگیرد و میتوانید روند محاسبات را مشاهده نمائید.
        </div>
        <div class="log">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo '<style>.log, .message { display: flex; }</style>';
                $function = $_POST["function"];
                $functionderivative = $_POST["functionderivative"];
                $initial = $_POST["initial"];
                echo 'تخمین اولیه: ' . $initial . '<hr>';
                echo 'تابع وارد شده: <code>' . $function . '</code><hr>';
                echo 'مشتق تابع وارد شده: <code>' . $functionderivative . '</code><hr>';
                $function = str_replace(' ', '', $function);
                function convert($input) {
                    $output = '';
                    for ($i = 0; $i < strlen($input); $i++) {
                        $char = $input[$i];
                        if ($i !== strlen($input)) {
                            $nextchar = $input[$i + 1];
                        } else {
                            $nextchar = null;
                        }
                        if ($i !== 0) {
                            $prechar = $input[$i - 1];
                        } else {
                            $prechar = null;
                        }
                        if ($char == '(') {
                            if ($prechar == 'x' || is_numeric($prechar)) {
                                $addoperator = ' *';
                            } else {
                                $addoperator = null;
                            }  
                        } else if ($char == ')') {
                            if ($nextchar == '(' || is_numeric($nextchar) || ctype_alpha($nextchar)) {
                                $addoperator = '* ';
                            } else {
                                $addoperator = null;
                            }  
                        }
                        if ($nextchar !== null && $prechar !== null) {
                            if ($char == '*' || $char == '/' || $char == '+' || $char == '-' || $char == '(' || $char == ')') {
                                if ($char == '(') {
                                    if ($prechar !== 'x' && ctype_alpha($prechar)) {
                                        $output .= $char . ' ';
                                    } else {
                                        $output .= $addoperator . ' ' . $char . ' ';
                                    }
                                } else if ($char == ')') {
                                    $output .= ' ' . $char . ' ' . $addoperator;
                                } else if ($char == '*' && $nextchar == '*') {
                                    $output .= ' ' . $char;
                                } else if ($char == '*' && $prechar == '*') {
                                    $output .= $char . ' ';
                                } else {
                                    $output .= ' ' . $char . ' ';
                                }
                            } else if ($char == 'x' && is_numeric($prechar)) {
                                $output .= ' * ' . $char;
                            } else {
                                $output .= $char;
                            }
                        } else {
                            $output .= $char;
                        }
                    }
                    return $output;
                }
                $function = convert($function);
                $function = str_replace('x', '$x', $function);
                echo 'تابع ترجمه شده: <code>' . $function . '</code><hr>';
                $functionderivative = convert($functionderivative);
                $functionderivative = str_replace('x', '$x', $functionderivative);
                echo 'مشتق تابع ترجمه شده: <code>' . $functionderivative . '</code>';
                function f($x) 
                {
                    global $function;
                    return eval("return $function;");
                }
                function df($x) 
                {
                    global $functionderivative;
                    return eval("return $functionderivative;");
                }
                $m = 0;
                $stop = false;
                $x = $initial;
                while ($m < 100) {
                    echo '<hr> تکرار شماره ' . $m . '<code>x=' . $x . ', f(x)=' . f($x) . ', df(x)/dx=' . df($x) . '</code>';
                    $oldx = $x;
                    $x =  $x - (f($x) / df($x));
                    echo 'پاسخ محاسبه شده: ' .  $x;
                    $delta = abs($x - $oldx) / abs($x);
                    if ($delta < pow(10, -7)) {
                        $stop = true;
                    }
                    if ($stop) {
                        break;
                    }
                    $oldx = $x;
                    $m++;
                }
            }
            ?>
        </div>
        </div><div class="footer">طراحی و توسعه داده شده توسط رضا سدید<a href="mailto:contact@rezasadid.com" style="min-width: calc(100% - 325px); text-align: left;">contact@rezasadid.com</a><a href="tel:02191302492">021-91302492</a></div>
    </div>
    <div class="pic">
        <img src="https://rezasadid.com/files/data/pattern-background.gif" alt="background" loop=infinite/><div></div>
    </div>
    <div class="msg">
        ریشه یابی - روش نیوتون
    </div>
    <h1 class="fa main">Numerical Analysis</h1>
</body>
</html>