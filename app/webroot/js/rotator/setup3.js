stepcarousel.setup({
	galleryid: 'gallery3', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	panelbehavior: {speed:500, wraparound:true, persist:false},
	defaultbuttons: {enable: false, moveby: 1, leftnav: ['leftnav.gif', -5, 80], rightnav: ['rightnav.gif', -18, 80]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['external', 'path_to_external_file']
});
