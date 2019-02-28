<div class="content">
	<div class="block">
		<div class="block-content">
			<div id='calendar'></div>	

		</div>
		
	</div>
	
	
</div>


<script type="text/javascript">
	
	$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
       	
       	 header: {
       	 	left:'prev,next today',
       	 	center: 'title',
       	 	right: 'month,basicWeek,basicDay' // buttons for switching between views
	    },
	    views: {
	        agendaFourDay: {
	            type: 'agenda',
	            duration: { days: 7},
	            buttonText: 'Próxima Semana'
	        }
	    },

	    navLinks: true,
	    editable: true,
	    eventLimit: true,
	    events:[{
	    	title:'Consulta',
	    	start:'2018-02-26'
	    }],



       	dayClick: function() {
        	alert('a day has been clicked!');
    	}
    })

});
</script>