<?php

                        ini_set('session.cookie_domain', '.farragutanchor.com');
                        session_start();

                        if (!empty($_SESSION['error'])) {
                            print_eol("                    <div class=\"row\">");
                            print_eol("                        <div class=\"container\">");
                            print_eol("                            <ul class=\"collapsible\" data-collapsible=\"accordion\">");
                            print_eol("                                <li>");
                            print_eol("                                    <div class=\"collapsible-header active\"><i class=\"material-icons\">error</i>Error</div>");
                            print_eol("                                    <div class=\"collapsible-body\" style=\"display: block; padding-top: 30px; margin-top: 0px; padding-bottom: 30px; margin-bottom: 0px; padding-left: 30px;\">");
                            foreach ($_SESSION['error'] as $str) {
                                print_eol("                                        <span>" . $str . "</span>");
                            }
                            print_eol("                                    </div>");
                            print_eol("                                </li>");
                            print_eol("                            </ul>");
                            print_eol("                        </div>");
                            print_eol("                    </div>");
                            unset($_SESSION['error']);
                        }
                        
                        function print_eol($str) {
                            echo $str . PHP_EOL;
                        }
                        
?>
