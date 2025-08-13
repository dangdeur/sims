<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
  <title>SIMS</title>
  <script src="<?= base_url('jquery/jquery-3.6.0.min.js') ?>"></script>


  <link rel="stylesheet" href="<?= base_url('css/css_nav.css') ?>">
  <link href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url("fa/css/all.css"); ?>" />

  <!-- <link href="<?= base_url('bootstrap/extensions/sticky-header/bootstrap-table-sticky-header.css') ?>" rel="stylesheet"> -->



  <link href="<?= base_url('css/navbars.css') ?>" rel="stylesheet">

  <style>
    table.floatThead-table {
    border-top: none;
    border-bottom: none;
    background-color: #fff;
}

    .judul{
        position:sticky;
        top: 0 ;
    }


/* th {
  //position: sticky;
  top: 50px;
  background: blue;
} */
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      $this->setUserSession($user);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>
  <style type="text/css">
    /* ============ desktop view ============ */
    @media all and (min-width: 992px) {

      .dropdown-menu li {
        position: relative;
      }

      .dropdown-menu .submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
      }

      .dropdown-menu .submenu-left {
        right: 100%;
        left: auto;
      }

      .dropdown-menu>li:hover {
        background-color: #f1f1f1
      }

      .dropdown-menu>li:hover>.submenu {
        display: block;
      }
    }

    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {

      .dropdown-menu .dropdown-menu {
        margin-left: 0.7rem;
        margin-right: 0.7rem;
        margin-bottom: .5rem;
      }

    }

    /* ============ small devices .end// ============ */
  </style>


  <script type="text/javascript">
    //	window.addEventListener("resize", function() {
    //		"use strict"; window.location.reload();
    //	});


    document.addEventListener("DOMContentLoaded", function () {


      /////// Prevent closing from click inside dropdown
      document.querySelectorAll('.dropdown-menu').forEach(function (element) {
        element.addEventListener('click', function (e) {
          e.stopPropagation();
        });
      })



      // make it as accordion for smaller screens
      if (window.innerWidth < 992) {

        // close all inner dropdowns when parent is closed
        document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
          everydropdown.addEventListener('hidden.bs.dropdown', function () {
            // after dropdown is hidden, then find all submenus
            this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
              // hide every submenu as well
              everysubmenu.style.display = 'none';
            });
          })
        });

        document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
          element.addEventListener('click', function (e) {

            let nextEl = this.nextElementSibling;
            if (nextEl && nextEl.classList.contains('submenu')) {
              // prevent opening link if link needs to open dropdown
              e.preventDefault();
              console.log(nextEl);
              if (nextEl.style.display == 'block') {
                nextEl.style.display = 'none';
              } else {
                nextEl.style.display = 'block';
              }

            }
          });
        })
      }
      // end if innerWidth

    });
    // DOMContentLoaded  end
  </script>



  <!-- Custom styles for this template -->

</head>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4$this->setUserSession($user);.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>
  <script src="/js/push.js"></script>