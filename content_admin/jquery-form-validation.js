(function() {
    $form_validator = {
        set_add_user_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    email_address: {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            }
                        }
                    },
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Confirm password is required'
                            },
                            identical: {
                                field: 'password',
                                message: 'Password and confirm password are not the same'
                            }
                        }
                    }
                }
            });
        },
        set_add_gallery_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_news_form_rules: function() {
            $('#form_news').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_gallery_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    }
                }
            });
        },
                set_add_page_form_rules: function() {
                    $('#form1').bootstrapValidator({
                        framework: 'bootstrap',
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            code: {
                                validators: {
                                    notEmpty: {
                                        message: 'Code is required'
                                    }
                                }
                            },
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Title is required'
                                    }
                                }
                            }
                        }
                    });
                },
        set_add_menu_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_comment_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    comment: {
                        validators: {
                            notEmpty: {
                                message: 'Comment is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_gold_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    per_gram: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            }
                        }
                    },
                    chapawala_gold_price: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            }
                        }
                    },
                    tejabhi_gold_price: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            }
                        }
                    },
                    silver_price: {
                        validators: {
                            notEmpty: {
                                message: 'This field is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_member_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_bichar_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    person_name: {
                        validators: {
                            notEmpty: {
                                message: 'Person name is required'
                            }
                        }
                    },
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_template_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    }
                }
            });
        },
        set_add_banner_form_rules: function() {
            $('#form1').bootstrapValidator({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    banner_title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    },
                    old_desktop_banner_image: {
                        validators: {
                            notEmpty: {
                                message: 'Desktop Banner Image is required'
                            },
                            file: {
                                extension: 'jpeg,jpg,png,gif',
                                type: 'image/jpeg,image/png,image/gif',
                                message: 'Only (png, jpg, jpeg, gif) files are allowed'
                            }
                        }
                    },
                    old_mobile_banner_image: {
                        validators: {
                            notEmpty: {
                                message: 'Mobile Banner Image is required'
                            },
                            file: {
                                extension: 'jpeg,jpg,png,gif',
                                type: 'image/jpeg,image/png,image/gif',
                                message: 'Only (png, jpg, jpeg, gif) files are allowed'
                            }
                        }
                    }
                }
            });
        },
    }
})(jQuery);


