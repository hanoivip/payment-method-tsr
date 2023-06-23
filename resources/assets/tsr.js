$(document).ready(function(){
	$('#cardtype').on('change', function () {
		event.preventDefault();
		//console.log(values_dynamic)
		var type = this.value
		//console.log(values_dynamic[type])
		$('#dvalue').empty()
		$('#dvalue').append(new Option("Choose card value", ""))
		if (values_dynamic[type])
		{
			for (const [key, value] of Object.entries(values_dynamic[type])) {
				$('#dvalue').append(new Option(value, key))
			}
		}
	})
})