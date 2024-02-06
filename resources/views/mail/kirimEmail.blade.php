<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>

	<style>
		table, td, div, h1, p {font-family: "Poppins", sans-serif;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
					<tr>
                        <td style="padding:36px 30px 42px 30px;">
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
									<td align="center" style="padding:10px 0 10px 0;;">
										<img src="{{ $message->embed($data['logo']) }}" alt="" width="200" style="height:auto;display:block;" />
									</td>
								</tr>
								<tr>
                                    <td align="center" style="padding:0 0 36px 0;color:#153643;">
										<h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">{{ $data['code'] }}</h1>
										<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Kode OTP Reset Password untuk email : {{ $data['email'] }} 
                                        </p>
										<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="http://www.example.com" style="text-decoration:underline;">ais-online.com</a></p>
									</td>
								</tr>
								
							</table>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
	</table>
</body>
</html>