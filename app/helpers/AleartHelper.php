<?php
// app/helpers/AlertHelper.php

class AlertHelper
{
    // Display a success message using SweetAlert
    public static function success($message)
    {
        echo '
        <script>
            $(document).ready(function(){ 
                swal({
                    title: "Success",
                    text: "' . $message . '",
                    icon: "success",
                });
            });
        </script>
        ';
    }
    
    // Display an error message using SweetAlert
    public static function error($message)
    {
        echo '
        <script>
            $(document).ready(function(){ 
                swal({
                    title: "Error",
                    text: "' . $message . '",
                    icon: "error",
                });
            });
        </script>
        ';
    }
    
    // Display a warning message using SweetAlert
    public static function warning($message)
    {
        echo '
        <script>
            $(document).ready(function(){ 
                swal({
                    title: "Warning",
                    text: "' . $message . '",
                    icon: "warning",
                });
            });
        </script>
        ';
    }
    
    // Display an info message using SweetAlert
    public static function info($message)
    {
        echo '
        <script>
            $(document).ready(function(){ 
                swal({
                    title: "Information",
                    text: "' . $message . '",
                    icon: "info",
                });
            });
        </script>
        ';
    }
}