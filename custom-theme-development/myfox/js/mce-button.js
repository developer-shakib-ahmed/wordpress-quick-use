/*

    http://www.wpexplorer.com/wordpress-tinymce-tweaks/

*/



(function() {
    tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
        editor.addButton( 'my_mce_button', {
            icon: 'New-Button',
            type: 'menubutton',
            menu: [
                {

                    text: '[features]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Features Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'features area title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[features title="' + e.data.textboxName + '" des="' + e.data.multilineName + '"]');
                            }
                        });
                    }

                },

                {

                    text: '[solid background]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Solid Background Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'solid background title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'backgroundc',
                                    label: 'Background Color',
                                    value: '#7542F9'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[solid_background title="' + e.data.textboxName + '" background_color="' + e.data.backgroundc + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },


                {

                    text: '[support]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Support Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'support title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'imageLink',
                                    label: 'Image Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'url',
                                    label: 'Page Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[support title="' + e.data.textboxName + '" img="' + e.data.imageLink + '" link="' + e.data.url + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },                

                {

                    text: '[mobile device]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Mobile Device Optimize area Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'mobile device optimize title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'image1Link',
                                    label: 'Left Side Image Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'image2Link',
                                    label: 'Right Side Image Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[mobile_device title="' + e.data.textboxName + '" img1="' + e.data.image1Link + '" img2="' + e.data.image2Link + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },               

                {

                    text: '[parallax section]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Parallax Section Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'parallax section title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'parallaxImage',
                                    label: 'Parallax Background Image',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'demolink',
                                    label: 'Demo Page Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'buylink',
                                    label: 'Buy Page Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[parallax title="' + e.data.textboxName + '" parallax_img="' + e.data.parallaxImage + '" demo_link="' + e.data.demolink + '" buy_link="' + e.data.buylink + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },

                {

                    text: '[crazy stunning]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Crazy Stunning Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'crazy stunning title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[crazy_stunning title="' + e.data.textboxName + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },                

                {

                    text: '[carousel]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Carousel Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'carousel title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'topImage',
                                    label: 'Carousel Top Image',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[carousel title="' + e.data.textboxName + '" img="' + e.data.topImage + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },                

                {

                    text: '[e-commerce]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert E-commerce Section Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'ecommerce section title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'logo',
                                    label: 'Woo commerce logo Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'econtent',
                                    label: 'E-commerce Screenshot Image Link',
                                    value: 'http://'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[ecommerce title="' + e.data.textboxName + '" toplogo="' + e.data.logo + '" screenshot_img="' + e.data.econtent + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },

                {

                    text: '[contact]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Contact Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Title',
                                    value: 'contact section title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'subtitle',
                                    label: 'Sub Title',
                                    value: 'contact section left side title'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Descriptions',
                                    value: 'You can write a lot of descriptions content in here ...',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[contact title="' + e.data.textboxName + '" subtitle="' + e.data.subtitle + '" des="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },

                {

                    text: '[map]',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert map Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'textboxName',
                                    label: 'Width',
                                    value: '100%'
                                },
                                {
                                    type: 'textbox',
                                    name: 'textboxName2',
                                    label: 'Height',
                                    value: '400'
                                },
                                {
                                    type: 'textbox',
                                    name: 'multilineName',
                                    label: 'Map src',
                                    value: 'you should insert you map embeded code here',
                                    multiline: true,
                                    minWidth: 300,
                                    minHeight: 100
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[map width="' + e.data.textboxName + '" height="' + e.data.textboxName2 + '" src="' + e.data.multilineName + '" ]');
                            }
                        });
                    }

                },

                {

                    text: '[funfact]',
                    onclick: function() {
                        editor.insertContent( '[funfact]');
                    }

                },

                {

                    text: '[testimonial]',
                    onclick: function() {
                        editor.insertContent( '[testimonial]');
                    }

                },

                {

                    text: '[introduce]',
                    onclick: function() {
                        editor.insertContent( '[introduce]');
                    }

                }
            ]
        });
    });
})();