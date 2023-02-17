<?php
    include('../connect.php');
    session_start();
    
    //logout
    if(isset($_GET['action']) && $_GET['action'] == 'logout'){
        session_destroy();
        header("Location:../index.php");
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">  
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../assests/fontawesome-free/css/all.min.css">
    <script src="../js/chart.js"></script>
    <script src="../button/buttons.html5.min.js"></script>
    <script src="../button/pdfmake.min.js"></script>
    <script src="../button/vfs_fonts.js"></script>
   <script src="../button/jszip.min.js"></script>
    <script src="../button/dataTables.buttons.min.js"></script>
    <script src="../button/buttons.print.min.js"></script>
    <link rel="stylesheet" href="../button/buttons.dataTables.min.css">
    <script src="../inc/dselect.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
    @media only print {
        footer, header, .sidebar {
            display:none;
        }
    }
</style>

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
        .bi{
            font-size: 20px;
        }
        .outer{
            float: left;
           
        }

        .rec{
            width: 98%;
        }

        .tablePOS{
            float: right;
            width: 40%;
           
        }
        .tablePOS table{
            opacity: 0%;
            pointer-events: none;
        }
        .outer{
           
            width: 60%;
        }

        .paginationpos{
           float: right;
            
            border-radius: 5px;
            display: flex;
             padding-left: 0;
             pointer-events: none;
            opacity: 0%;
            padding: 10px;
        }
        .paginationpos ul{
            padding: 5px;
            display: block;
            list-style-type: disc;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;
            height: 2px;
            padding-top: 0px;
            margin-top: 0px;
            margin-left: 2px;
            
        }
        .paginationpos li{
            list-style: none;
            display: inline-block;
            text-decoration: none;
            padding: 0px;
           
           
            
        }

        .paginationpos li a{
            text-decoration: none;
           
            padding: 0px;
        }
        

        button.dt-button, div.dt-button, a.dt-button, input.dt-button{
            background-color: #116634;
            color: white;

            padding: .25rem .5rem;
            font-size: .875rem;
            border-radius: .2rem;
        }
        .form-select{ width: auto; min-width: 60%;}
       
        .rad .form-check-label{
            padding-left: 5px;
            margin-right: 10px;
            font-weight: 100;
        }

        .rad .form-check-input{
            padding: 4px;
        }
        

        .info-box {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            border-radius: 0.25rem;
            background-color: #fff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            padding: .5rem;
            position: relative;
            width: 100%;
        }
        .form-group{
            padding: 6px;
        }
       
        .form-group label{
            font-weight: 550;
        }
        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 10px;
        }

        .info-box .info-box-icon {
            border-radius: 0.25rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }
        .info-box .progress-description, .info-box .info-box-text {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis; 
            white-space: nowrap; 
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        .info-box .info-box-number {
            display: block;
            margin-top: .25rem;
            font-weight: 700;
        }
        .elevation-1 {
            box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%) !important;
        }
        .bg-warning {
            background-color: #ffc107 !important;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }


        .myContainer{
            position: relative;
            width: 100%;

        }

        .navtitle{
            margin-right: 45%;
            padding-top: 10px;
            text-decoration: none;
            margin-left: 0;
        }
        .navtitle a{
            text-decoration: none;
            color: rgb(202, 202, 202);
        }
        .myNavigation{
            position: fixed;
            width: 199px;
            height: 100%;
            background: #116634;
            box-shadow: 66px 80px 80px rgba(20, 5, 5, 0.25);
            
            transition: 0.7s;
            overflow: hidden;
            
        }

        .page-item.active .page-link {
            
            background-color: #198754;
            border-color: #116634;
        }
        .form-control-sm {
    
    
            border-radius: 3rem;
        }
        #logoutmodal .btn-primary{
            margin-right: 77%;
        }
        .myNavigation ul{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding-left: 0px;
            
        }
        .myNavigation.active{
            width: 60px;
        }
        .myNavigation ul li{
            position: relative;
            width: 200%;
            list-style: none;
            border-radius: 3.9px;
            padding-top: 5px;
            padding-bottom: 13px;
            
        }
        .myNavigation ul li:hover{
            background: #41ac6d;
            
        }
        .myNavigation ul li:nth-child(1){
            margin-bottom: 40px;
            background: #cfcfcf;
            width: 100%;
            border-bottom: #ce2027;
            padding-left: 0px;
            padding-right: 0;
            border-radius: 0px;
            padding-bottom: 20px;
            color: #116634;
        }
        .myNavigation ul li:nth-child(1) a{
            color: #116634;
        }
        .myNavigation ul li:nth-child(1):hover{
            background: #5d927e;
            
        }
        .myNavigation ul li a:nth-child(1):hover{
            color: white;
            
        }
        .myNavigation ul li a{
            position: relative;
            display: block;
            width: 100%;
            display: flex;
            text-decoration: none;
            color: white;
           
            font-size: 17px;
        }
        .myNavigation ul li a:hover{
            color: #116634;
        }
        .myNavigation ul li a .icon{
            position: relative;
            display: block;
            min-width: 60px;
            height: 25px;
            text-align: center;
            line-height: 39px;
            
        }
        .myNavigation ul li a .img{
            position: relative;
            display: block;
            min-width: 60px;
            height: 25px;
            text-align: center;
            line-height: 39px;
            
                
        }
        .myNavigation ul li a .icon .fas{
            font-size: 17px;
           
        }
        .myNavigation ul li a .title{
            position: relative;
            display: block;
            height: 25px;
            line-height: 40px;
            text-align: start;
            white-space: nowrap;
            
        }
                        
        h7{
            color: white;
            background: red;
            font-weight: bold;
            padding: 5px;
            border-radius: 10px;
            font-size: 12px;
        }
        h8{
           color: white;
           background: green;
           width: 25%;
           padding: 5px;
           border-radius: 10px;
           font-size: 12px;
           font-weight: bold;
        }

        th{
            font-weight: 550;
        }
        .main{
            position: absolute;
            width: calc(100% - 200px);
            left: 199px;
            min-height: 100vh;
            background: white;
            transition: 0.5s;
        }
        .main.active{
            width: calc(100% - 60px);
            left: 60px;
        }
        .topbar{
            width: 100%;
            height: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0 10px;
            background-color: #2d8b17;
            
        }
        .toggle{
            position: relative;
            
            
            display: flex;
            font-size: 1.3em;
            cursor: pointer;
            padding-top: 13.6px;
        }
        .topbar .profile{
            margin-top: 9px;
            font-size: large;
            border: 1px solid #ce2027;
            background-color: #cfcfcf;
            border-radius: 20px;
           
        }
        .topbar .profile .name{
            padding: 10px;
            color: black;
        }
        .myNavigation ul li.active{
            background: #ce2027;
        }
       
        .link{
            background: none;
            border: none;
            text-decoration: none;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
            padding: 0;
            
        }
        .card-primary.card-outline {
          border-top: 3px solid #2d8b17;
        }
        
        .card{
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            margin-bottom: 1rem;
            margin-top: 1.5%;
            padding-right: 7.5px;
            padding-left: 7.5px;
            margin-right: 1.5%;
            margin-left: 1.5%;
            }
        
        .main_content{
            width: 100%;
            height: 100%;
        }


        .align-items-end {
            -ms-flex-align: end !important;
            align-items: flex-end !important;
        }
        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }

        
    </style>
  
    <title>SaveMart Stock Management System</title>
</head>
<body>
    
