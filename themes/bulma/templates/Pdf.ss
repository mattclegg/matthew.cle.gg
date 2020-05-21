<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<%--	<% base_tag %>--%>
	<base href="http://localhost/"><!--[if lte IE 6]></base><![endif]-->
	<title>Matthew.Cle.gg - $Title</title>
	<% require themedCSS('pdf') %>
	<link rel="stylesheet" type="text/css" href="http://localhost/$ThemeDir/css/pdf.css" />
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
						<td><a href="m@cle.gg" style="text-decoration: none">m@cle.gg</a></td>
					</tr>
					<tr>
						<td>+44 (0) 7478 575533</td>
					</tr>
				</table>
			</th>
			<td rowspan="2" align="right">
				<img src="$ThemeDir/media/240x320_300.jpg" width="90px" height="120px"/>
			</td>
		</tr>
		<tr>
			<td>
				<p>Over <strong>15</strong> years of industry experience, developing with client, server and infrastructure technologies. Skilled in automation cloud orchestration tools (Kubernetes, Terraform, Helm, Ansible etc), server-side technologies (Python, PHP, Ruby) & client front-end languages (HTML, CSS and JavaScript). I have experience creating and hosting websites using complex math & basic logic for most common content management systems. My previous work experience includes projects with numerous digital agencies, startups and corporations.</p>
			</td>
		</tr>
	</tbody>
</table>
<hr style="background:#616161;"/>
<% loop $PositionDescription %>
	<table>
		<% with $Position %>
			<thead>
				<tr>
					<th>
						<h3>$Title</h3>
					</th>
					<th>
						<address>$Location</address>
					</th>
					<th>
						<time>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
							$Date
						</time>
					</th>
				</tr>
			</thead>
		<% end_with %>
		<tbody>
			<tr>
				<td colspan="3">
					$Content
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">
					<% loop $OtherPages($Top.ID) %>
						<a class="tag" href="$Link" title="$MenuTitle.XML">$Tag</a>
					<% end_loop %>
				</td>
			</tr>
		</tfoot>
	</table>
	<hr/>
<% end_loop %>
<footer>
	<h6>Hobbies &amp; interests</h6>
	<p>My favourite hobbies include long distance cycling, short distance running and hiking.</p>
	<p>I am also interested in cooking and photography.</p>
</footer>
</body>
</html>