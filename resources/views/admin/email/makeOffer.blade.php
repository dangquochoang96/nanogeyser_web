<html>
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{!! $title !!}</title>
        <style type="text/css">
            .container {
                max-width: 768px;
                margin-right: auto;
                margin-left: auto;
            }
            .portlet.light {
                padding: 12px 20px 15px;
                background-color: #fff;
            }
            .portlet.light .portlet-body {
                padding-top: 8px;
            }
            .portlet>.portlet-body {
                clear: both;
                -webkit-border-radius: 0 0 4px 4px;
                -moz-border-radius: 0 0 4px 4px;
                -ms-border-radius: 0 0 4px 4px;
                -o-border-radius: 0 0 4px 4px;
                border-radius: 0 0 4px 4px;
            }
            .form {
                padding: 0!important;
            }
            .form .form-body, .portlet-form .form-body {
                padding: 20px;
            }
            .m-b-20 {
                margin-bottom: 20px !important;
            }
            .m-t-20 {
                margin-top: 20px !important;
            }
            .text-center {
                text-align: center;
            }
            .m-t-0 {
                margin-top: 0px !important;
            }
            .font-yellow-casablanca {
                color: #f2784b!important;
            }
            .title {
                font-size: 28px;
                font-weight: 300;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }
            .btn {
                display: inline-block;
                text-align: center;
                cursor: pointer;
                padding: 6px 12px;
                font-size: 14px;
                text-decoration: none;
                text-transform: uppercase;
                color: #FFF;
                background-color: #3598dc;
                border-color: #3598dc;
            }

        </style>
    </head>
    <body style="background-color: #eff3f8; font-family: 'Open Sans',sans-serif;padding:50px 0; color:#333">
        <div class="container">
            <div class="page-content-inner m-t-20">
                <div class="portlet light">
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="m-b-20">
                                <h1 class="font-yellow-casablanca m-t-0 title">{!! $title !!}</h1>
                                <div class="m-t-20 m-b-20">{!! $content !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
