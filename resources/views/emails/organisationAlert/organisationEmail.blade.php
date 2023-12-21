<html>
<body>
	<p>
		Hello {{ $user->name ?? "" }},<br><br>
			The organisation <b>{{ $organization->name ?? "" }}</b> is successfully registered. <br>

			Trial Ends on : {{ $$organization->trial_end ?? "" }} <br><br>

			Thanks and Regards,<br>
			Clubwise.

	</p>
</body>

</html>