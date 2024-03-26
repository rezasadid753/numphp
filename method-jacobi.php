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
        <h1 class="fa">انتگرال گیری عددی - روش ژاکوبی</h1>
        <p>
            با وارد کردن سه معادله بر حسب x و y و z با سه مجهول x و y و z در فرم زیر، مجهولات آن با استفاده از روش ژاکوبی با صفر قرار دادن نقاط اولیه برای هر سه متغیر و تکرار تا زمانی که چهار رقم بامعنا هر سه متغیر ثابت بماند محاسبه میشود. در صورت تمایل می‌توانید معادلات دلخواه خود را در فرم وارد کنید یا با کلیک بر روی دکمه پایین فرم، از معادلات پیش‌فرض برای محاسبات استفاده کنید.
        </p>
        <div class="message">برای مشاهده پاسخ اسکرول کنید</div>
        <form id="mainform" method="post" action="">
            <div class="inp custom3">
                <input type="text" name="function1" id="v1">
                <label onclick="focusinp('v1')" for="v1">معادله اول</label>
                <span>x=</span>
            </div>
            <div class="inp custom3">
                <input type="text" name="function2" id="v2">
                <label onclick="focusinp('v2')" for="v2">معادله دوم</label>
                <span>y=</span>
            </div>
            <div class="inp custom3">
                <input type="text" name="function3" id="v3">
                <label onclick="focusinp('v3')" for="v3">معادله سوم</label>
                <span>z=</span>
            </div>
            <button type="submit">ثبت</button>
        </form>
        <div class="separator"><div class="line"></div><p>یا</p><div class="line"></div></div>
        <button type="button" onclick="methodjacobi()">حل دستگاه <code>7x+y+z=2</code> و <code>2x+15y-6z=5</code> و <code>2x-y+5z=8</code></button>
        <div class="note"><span>↵</span>
            معادلات به ترتیب بصورت 
            <code>x=(2-y-z)/7</code>
             و 
            <code>y=(5-(2x+6z))/15</code>
             و 
            <code>z=(8-2x+y)/5</code>
             بازنویسی میشوند تا بتوان در رابطه جایگذاری کرد
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
                $function1 = $_POST["function1"];
                $function2 = $_POST["function2"];
                $function3 = $_POST["function3"];
                echo 'معادله اول وارد شده: <code>x=' . $function1 . '</code><hr>';
                echo 'معادله دوم وارد شده: <code>y=' . $function2 . '</code><hr>';
                echo 'معادله سوم وارد شده: <code>z=' . $function3 . '</code><hr>';
                $function1 = str_replace(' ', '', $function1);
                $function2 = str_replace(' ', '', $function2);
                $function3 = str_replace(' ', '', $function3);
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
                            if (($chprecharar == 'x' || $prechar == 'y' || $prechar == 'z') || is_numeric($prechar)) {
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
                                    if (($prechar !== 'x' || $prechar !== 'y' || $prechar !== 'z') && ctype_alpha($prechar)) {
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
                            } else if (($char == 'x' || $char == 'y' || $char == 'z') && is_numeric($prechar)) {
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
                $function1 = convert($function1);
                $function1 = str_replace('x', '$x', $function1);
                $function1 = str_replace('y', '$y', $function1);
                $function1 = str_replace('z', '$z', $function1);
                $function2 = convert($function2);
                $function2 = str_replace('x', '$x', $function2);
                $function2 = str_replace('y', '$y', $function2);
                $function2 = str_replace('z', '$z', $function2);
                $function3 = convert($function3);
                $function3 = str_replace('x', '$x', $function3);
                $function3 = str_replace('y', '$y', $function3);
                $function3 = str_replace('z', '$z', $function3);
                echo 'معادله ترجمه شده اول: <code>$x = ' . $function1 . '</code><hr>';
                echo 'معادله ترجمه شده دوم: <code>$y = ' . $function2 . '</code><hr>';
                echo 'معادله ترجمه شده سوم: <code>$z = ' . $function3 . '</code>';
                function f1($y, $z) 
                {
                    global $function1;
                    return eval("return $function1;");
                }
                function f2($x, $z) 
                {
                    global $function2;
                    return eval("return $function2;");
                }
                function f3($y, $z) 
                {
                    global $function3;
                    return eval("return $function3;");
                }
                $m = 0;
                $x = 0;
                $y = 0;
                $z = 0;
                $oldx = 0;
                $oldy = 0;
                $oldz = 0;
                $stop = false;
                while ($m < 100) {
                    echo '<hr> تکرار شماره ' . $m;
                    $x = f1($y, $z);
                    $y = f2($x, $z);
                    $z = f3($y, $z);
                    echo '<code>x=' . $x . ', y=' . $y . ', z=' . $z . '</code>';
                    $delta1 = abs($x - $oldx) / abs($x);
                    $delta2 = abs($y - $oldy) / abs($y);
                    $delta3 = abs($z - $oldz) / abs($z);
                    if ($delta1 < pow(10, -4) && $delta2 < pow(10, -4) && $delta3 < pow(10, -4)) {
                        $stop = true;
                    }
                    if ($stop) {
                        break;
                    }
                    $oldx = $x;
                    $oldy = $y;
                    $oldz = $z;
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
        انتگرال گیری عددی - روش ژاکوبی
    </div>
    <h1 class="fa main">Numerical Analysis</h1>
</body>
</html>