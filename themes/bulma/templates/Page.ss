<!DOCTYPE html>
<html lang="en" style="background-image: url('$ThemeDir/media/1920x1440_72.jpg');">
<head>
	<meta charset="utf-8">
	<% base_tag %>
	<title>Matthew.Cle.gg - $Title</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<% require themedCSS('index') %>
</head>
<body>
	<div class="columns">
		<header class="column">
			<div>
				<h1>Matthew<i>.</i>Cle<i>.</i>gg</h1>
				<a href="/">
					<img class="app-header-avatar" src="$ThemeDir/media/240x320_300.jpg">
				</a>
				<div class="box">
					<h2>I am a $Title</h2>
					<p>Over <strong>$ExperienceYears</strong> of industry experience, developing with client, server and infrastructure technologies.</p>
				</div>
				<nav style="margin-bottom: 1.2em;">
					<ul style="padding: 0;margin: 0;list-style: none;">
						<li>
							<a class="button" href="mailto:m@cle.gg" target="_blank">Contact me!</a>
						</li>
					</ul>
				</nav>
				<div class="app-header-social">
					<a target="_blank" href="https://github.com/mattclegg/"><svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
					<a target="_blank" href="https://stackoverflow.com/users/977957/matt-clegg"><svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 120 120"><path d="M84.4 93.8V70.6h7.7v30.9H22.6V70.6h7.7v23.2z"/><path d="M38.8 68.4l37.8 7.9 1.6-7.6-37.8-7.9-1.6 7.6zm5-18l35 16.3 3.2-7-35-16.4-3.2 7.1zm9.7-17.2l29.7 24.7 4.9-5.9-29.7-24.7-4.9 5.9zm19.2-18.3l-6.2 4.6 23 31 6.2-4.6-23-31zM38 86h38.6v-7.7H38V86z"/></svg></a>
		<%--			https://join.slack.com/t/clegg/shared_invite/zt-e80fks1z-LA6Tntc_DJSBQU_7CURDHw--%>
				</div>
				<hr>
			</div>
		</header>
		<main class="column app-container">
			<article class="post">
				<blockquote>Skilled in automation cloud orchestration tools (Kubernetes, Terraform, Ansible etc), server-side technologies (GoLang, Python, PHP) & client front-end languages (HTML, CSS and JavaScript). I have experience creating and hosting websites using complex math & basic logic for most common content management systems. My previous work experience includes projects with numerous digital agencies, startups and corporations.</blockquote>
				<hr>
				<div class="box">
					<% loop $SortedPositionDescription %>
						<article>
							<% with $Position %>
								<hgroup>
									<picture class="is-64x64">
										$CompanyLogo
									</picture>
									<h3>$Title</h3>
									<address>$Location</address>
									<time>
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
										$Date
									</time>
								</hgroup>
							<% end_with %>
							$Content
							<% if $OtherPages($Top.ID) %>
								<div>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tag">
										<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line>
									</svg>
									<% loop $OtherPagesLimited($Top.ID).Sort(MenuTitle) %>
										<a class="tag" href="$StaticLink" title="$Title.XML">$MenuTitle</a>
									<% end_loop %>
								</div>
							<% end_if %>
						</article>
					<% end_loop %>
					$Form
				</div>
			</article>
			<footer>
				<h6>Hobbies &amp; interests</h6>
				<p>My favourite hobbies include long distance cycling, short distance running and hiking.</p>
				<p>I am also interested in cooking and photography.</p>
			</footer>
		</main>
	</div>
</body>
</html>
