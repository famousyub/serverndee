<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>authentification </title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link rel="styleshhet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
</head>
<body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>




    <script>
//prefixes of implementation that we want to test
window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;

//prefixes of window.IDB objects
window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;
window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange

if (!window.indexedDB) {
    window.alert("Your browser doesn't support a stable version of IndexedDB.")
}

const employeeData = [{
    id: "00-01",
    name: "gopal",
    age: 35,
    email: "gopal@tutorialspoint.com"
}, {
    id: "00-02",
    name: "prasad",
    age: 32,
    email: "prasad@tutorialspoint.com"
}];

var db;
var request = window.indexedDB.open("newDatabase", 1);

request.onerror = function (event) {
    console.log("error: ");
};

request.onsuccess = function (event) {
    db = request.result;
    console.log("success: " + db);
    loadTable();
};

request.onupgradeneeded = function (event) {
    var db = event.target.result;
    var objectStore = db.createObjectStore("employee", {
        keyPath: "id"
    });

    for (var i in employeeData) {
        objectStore.add(employeeData[i]);
    }
}

function loadTable() {
    var employees = "";
    $('.employee').remove();

    var objectStore = db.transaction("employee").objectStore("employee");
    objectStore.openCursor().onsuccess = function (event) {
        var cursor = event.target.result;
        if (cursor) {
            employees = employees.concat(
                '<tr class="employee">' +
                '<td class="ID">' + cursor.key + '</td>' +
                '<td class="Name">' + cursor.value.name + '</td>' +
                '<td class="Age">' + cursor.value.age + '</td>' +
                '<td class="Email">' + cursor.value.email + '</td>' +
                '</tr>');

            cursor.continue(); // wait for next event
        } else {
            $('.header').after(employees); // no more events
        }
    };
}

function addEmployee() {
    var employeeID = $('#add_id').val();
    var name = $('#add_name').val();
    var age = $('#add_age').val();
    var email = $('#add_email').val();
    var request = db.transaction(["employee"], "readwrite")
        .objectStore("employee")
        .add({
            id: employeeID,
            name: name,
            age: age,
            email: email
        });

    request.onsuccess = function (event) {
        loadTable();
        clearButtons();
    };

    request.onerror = function (event) {
        alert("error");
    }
}

function deleteEmployee() {
    var employeeID = $('#delete_id').val();
    var request = db.transaction(["employee"], "readwrite")
        .objectStore("employee")
        .delete(employeeID);

    request.onsuccess = function (event) {
        loadTable();
        clearButtons();
    };
}

function clearButtons() {
    $('#add_id').val("");
    $('#add_name').val("");
    $('#add_age').val("");
    $('#add_email').val("");
    $('delete_id').val("");
}

        </script>



<table border="1">
    <tr class="header">
        <th style="width:2em">ID</th>
        <th style="width:6em">Name</th>
        <th style="width:2em">Age</th>
        <th style="width:14em">Email</th>
    </tr>
</table>
<br>
<button onclick="addEmployee()">Add</button>
<input id="add_id" type="text" placeholder="ID">
<input id="add_name" type="text" placeholder="Name">
<input id="add_age" type="text" placeholder="Age">
<input id="add_email" type="text" placeholder="Email"><br>
<button onclick="deleteEmployee()">Delete</button>
<input id="delete_id" type="text" placeholder="ID">


<script>
 /** 
         * Ref. https://www.cnblogs.com/as3lib/p/6789647.html
         * Ref. https://jsfiddle.net/we9L9h2r/
 */
 $(document).ready(() => {
            //滾動事件
  $(document).scroll(() => {
    let topNav = $('#myNav').offset().top; 
    let top01 = $('#section_history').offset().top; 
    let top02 = $('#section_vintage').offset().top; 
    let top03 = $('#section_local').offset().top; 
    let top04= $('#section_worldwide').offset().top; 
    let top05= $('#section_fair').offset().top; 

    // $('div#debug_msg').text(`Nav.top: ${topNav}, 商品介紹: ${top01}, 規格說明: ${top02}, 運送方式: ${top03}`);// for debug

    if(topNav > top01){ //當 nav 滾到 area01 的區域內
      $('#menu02, #menu03, #menu04, #menu05').removeClass('link').addClass('active'); 
      $('#menu01').addClass('active').removeClass('link'); 
    } else {
       $('#menu01').addClass('link').removeClass('active'); 
    }

    if(topNav > top02){ //當 nav 滾到 area02 的區域內
      $('#menu01, #menu03, #menu04, #menu05').removeClass('active').addClass('link'); 
       $('#menu02').addClass('active').removeClass('link'); 
    } else {
      $('#menu02').addClass('link').removeClass('active'); 
    }

    if(topNav > top03){ //當 nav 滾到 area03 的區域內
        $('#menu01, #menu02, #menu04, #menu05').removeClass('active').addClass('link'); 
        $('#menu03').addClass('active').removeClass('link'); 
    } else {
        $('#menu03').addClass('link').removeClass('active'); 
      }
    
    if(topNav > top04){ //當 nav 滾到 area04的區域內
        $('#menu01, #menu02, #menu03, #menu05').removeClass('active').addClass('link'); 
        $('#menu04').addClass('active').removeClass('link'); 
    } else {
        $('#menu04').addClass('link').removeClass('active'); 
      }
    
    if(topNav > top05){ //當 nav 滾到 area04的區域內
        $('#menu01, #menu02, #menu03, #menu04').removeClass('active').addClass('link'); 
        $('#menu05').addClass('active').removeClass('link'); 
    } else {
        $('#menu05').addClass('link').removeClass('active'); 
      }
  });
});


// 有些同學會想要試著用行動裝置來瀏覽自己製作的捲動式網頁，但卻會發現觸控與捲動發生異常，這是 skrollor 套件的問題。請在 JS 的編輯區中加上 document.body.id = "skrollr-body“
// 這段語法，在行動裝置上的瀏覽就會正常了

document.body.id = "skrollr-body"

$(window).scroll(function(evt){
  if($(window).scrollTop()>0)
    $(".navbar").addClass("navbar-top01");
  else
    $(".navbar").removeClass("navbar-top01");
});

var s =skrollr.init();
    </script>
</body>
</html>