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
        <h1 class="fa">ریشه یابی - روش تکرار ساده</h1>
        <p>
            با وارد کردن تابع مورد نظر در فرم زیر، یکی از ریشه‌های آن در دامنه تعیین‌شده با استفاده از روش تکرار ساده (نقطه ثابت) محاسبه می‌شود. تکرارها تا زمانی که 4 رقم بامعنا g و x باهم برابر باشند و در نهایت ریشه تابع با تقریب بدست می‌آید. در صورت تمایل می‌توانید تابع دلخواه خود را در فرم وارد کنید یا با کلیک بر روی دکمه پایین فرم، از یک تابع پیش‌فرض برای محاسبات استفاده کنید.
        </p>
        <div class="message">برای مشاهده پاسخ اسکرول کنید</div>
        <form id="mainform" method="post" action="">
            <div class="inp custom1">
                <input type="text" name="function" id="v1">
                <label onclick="focusinp('v1')" for="v1">تابع g</label>
                <span>x=</span>
            </div>
            <div class="inp">
                <input type="text" name="a" id="v2">
                <label onclick="focusinp('v2')" for="v2">ابتدای دامنه</label>
            </div>
            <div class="inp">
                <input type="text" name="b" id="v3">
                <label onclick="focusinp('v3')" for="v3">انتهای دامنه</label>
            </div>
            <div class="inp">
                <input type="text" name="initial" id="v4">
                <label onclick="focusinp('v4')" for="v4">تخمین اولیه</label>
            </div>
            <button type="submit">ثبت</button>
        </form>
        <div class="separator"><div class="line"></div><p>یا</p><div class="line"></div></div>
        <button type="button" onclick="methodfixedpointiteration()">محاسبه ریشه تابع <code>(2x+5)*sin(x)+6</code> در بازه 0 تا 5</button>
        <div class="note"><span>↵</span>
            در تابع پیشفرض، تابع بصورت 
            <code>(2x+5)*sin(x)+6+100x=100x</code>
             بازنویسی شده است که تابع g برابر خواهد بود با 
            <code>((2x+5)*sin(x)+6+100x)/100</code>
             و مقدار تخمین اولیه نیز 0 درنظر گرفته شده است
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
                $a = $_POST["a"];
                $b = $_POST["b"];
                $initial = $_POST["initial"];
                echo 'مقدار تخمین اولیه: ' . $initial . '<hr>';
                echo 'دامنه مدنظر: ' . $a . ' تا ' . $b . '<hr>';
                echo 'تابع وارد شده: <code>x=' . $function . '</code><hr>';
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
                echo 'تابع ترجمه شده: <code>g( $x ) = ' . $function . '</code>';
                function f($x) 
                {
                    global $function;
                    return eval("return $function;");
                }
                $m = 0;
                $stop = false;
                while ($m < 100) {
                    echo '<hr> تکرار شماره ' . $m . '<code>x=' . $initial . ', g(x)=' . f($initial) . '</code>';
                    $difference = abs($initial - f($initial)) / abs($initial) >= pow(10, -4);
                    if ($initial !== f($initial) && $difference ) {
                        $initial = f($initial);
                    } else {
                        echo 'ریشه بصورت دقیق در x = ' . $initial . 'پیدا شده است';
                        break;
                    }
                    echo 'پاسخ محاسبه شده: ' . $initial;
                    if (f($initial) !== null) {
                        $delta = abs($initial - f($initial)) / abs($initial);
                        if ($delta < pow(10, -4)) {
                            $stop = true;
                        }
                    }
                    if ($stop) {
                        break;
                    }
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
        ریشه یابی - روش تکرار ساده
    </div>
    <h1 class="fa main">Numerical Analysis</h1>
</body>
</html>