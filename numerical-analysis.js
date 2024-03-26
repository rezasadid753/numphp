document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".inp input");

    inputs.forEach(input => {
        input.addEventListener("input", function () {
            const label = this.nextElementSibling;
            label.classList.toggle("up", this.value.trim() !== "");
        });
    });
});

function focusinp(inp) {
    if (inp == 'v1') {
        document.getElementById("v1").focus();
    } else if (inp == 'v2') {
        document.getElementById("v2").focus();
    } else if (inp == 'v3') {
        document.getElementById("v3").focus();
    } else if (inp == 'v4') {
        document.getElementById("v4").focus();
    } else if (inp == 'v5') {
        document.getElementById("v5").focus();
    } else if (inp == 'v6') {
        document.getElementById("v6").focus();
    } else if (inp == 'v7') {
        document.getElementById("v7").focus();
    } else if (inp == 'v8') {
        document.getElementById("v8").focus();
    } else if (inp == 'v9') {
        document.getElementById("v9").focus();
    }
}

function methodbisection () {
    var predefinedValues = {
        function: "(2x+5)*sin(x)+5",
        a: 0,
        b: 5
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.a;
    document.getElementById("v3").value = predefinedValues.b;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodfalseposition() {
    var predefinedValues = {
        function: "(2x+5)*sin(x)+5",
        a: 0,
        b: 5
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.a;
    document.getElementById("v3").value = predefinedValues.b;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodfixedpointiteration() {
    var predefinedValues = {
        function: "((2x+5)*sin(x)+6+100x)/100",
        a: 0,
        b: 5,
        initial: 0
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.a;
    document.getElementById("v3").value = predefinedValues.b;
    document.getElementById("v4").value = predefinedValues.initial;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodnewtonraphson() {
    var predefinedValues = {
        function: "(2x+5)*sin(x)+5",
        functionderivative: "(2*sin(x))+((2*x+5)*cos(x))",
        initial: 3
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.functionderivative;
    document.getElementById("v3").value = predefinedValues.initial;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodsecant() {
    var predefinedValues = {
        function: "(2x+5)*sin(x)+5",
        a: 3,
        b: 4
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.a;
    document.getElementById("v3").value = predefinedValues.b;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodtrapezoid() {
    var predefinedValues = {
        function: "(2x+5)*sin(x)+5",
        a: 0,
        b: 5,
        n: 20
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.a;
    document.getElementById("v3").value = predefinedValues.b;
    document.getElementById("v4").value = predefinedValues.n;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodsimpson() {
    var predefinedValues = {
        function: "(2x+5)*sin(x)+5",
        a: 0,
        b: 5,
        n: 20
    };
    document.getElementById("v1").value = predefinedValues.function;
    document.getElementById("v2").value = predefinedValues.a;
    document.getElementById("v3").value = predefinedValues.b;
    document.getElementById("v4").value = predefinedValues.n;
    document.querySelector("#mainform button[type='submit']").click();
}

function methodjacobi() {
    var predefinedValues = {
        function1: "(2-y-z)/7",
        function2: "(5-(2*x)+(6*z))/15",
        function3: "(8-(2*x)+(y))/5"
    };
    document.getElementById("v1").value = predefinedValues.function1;
    document.getElementById("v2").value = predefinedValues.function2;
    document.getElementById("v3").value = predefinedValues.function3;
    document.querySelector("#mainform button[type='submit']").click();
}