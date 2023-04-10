<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<base href="https://matthew.cle.gg/"><!--[if lte IE 6]></base><![endif]-->
	<title>Matthew.Cle.gg - $Title</title>
	<style>
		$inlinecss('pdf').RAW
	</style>
</head>
<body>
<table>
	<tbody>
		<tr>
			<th>
				<table>
					<tr>
						<td rowspan="2">
							<h1>Matthew Clegg - $Title</h1>
						</td>
						<td style="text-align:right;"><a href="m@cle.gg" style="text-decoration: none">m@cle.gg</a></td>
					</tr>
					<tr>
						<td style="text-align:right;">+44 (0) 7478 575533</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr>
			<td>
				<p>Over <strong>$ExperienceYears</strong> of industry experience, developing with client, server and infrastructure technologies. Skilled in automation cloud orchestration tools (Kubernetes, Terraform, Helm, Ansible etc), server-side technologies (GoLang, Python, PHP) & client front-end languages (HTML, CSS and JavaScript). I have experience creating and hosting websites using complex math & basic logic for most common content management systems. My previous work experience includes projects with numerous digital agencies, startups and corporations.</p>
			</td>
		</tr>
	</tbody>
</table>
<hr style="background:#616161;"/>
<% loop $SortedPositionDescription %>
	<table class="position">
		<tr>
			<td class="logo">
				<table>
					<thead>
						<% with $Position %>
						<tr>
							<th>
								<h3>$Title</h3>
								$Location $Date
							</th>
							<th>
								<img src="$CompanyLogo64" />
							</th>
						</tr>
						<% end_with %>
					</thead>
					<tbody>
						<tr>
							<td colspan="2">
								$Content
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">
								<% loop $OtherPages($Top.ID) %>
									<a class="tag" href="$PDFLink" title="$MenuTitle.XML">$Tag</a>
								<% end_loop %>
							</td>
						</tr>
					</tfoot>
				</table>
			</td>
		</tr>
	</table>
<% end_loop %>
<footer>
	<h4>Hobbies &amp; interests</h4>
	<p>My favourite hobbies include long distance cycling, short distance running and hiking.</p>
	<p>I am also interested in cooking and photography.</p>
</footer>
</body>
</html>
