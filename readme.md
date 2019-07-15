# SurveyDownload
SurveyDownload is a web app which allows download of a control file for the PIEL Survey. This can simplify delivery of surveys to participants. The normal way of distributing surveys by email works well but can be a lot of work if there are large numbers of participants. This  code demonstrates 2 other ways of providing surveys to participants.

1. Form
A form can be placed on a web site to allow participants to enter their participant id. The participant can submit this form on their phone and the control file will immediately download onto their device.
2. Link
A link can be sent to participants. This link will containt the name of the survey and their individual participant id. The participant can tap the email link on their phone and the control file will immediately download onto their device.

The PIEL Survey app is a research tool which conducts surveys using Ecological Momentary Assessment Methodology (EMA), otherwise known as Experience Sampling Methodology (ESM). It is available as an iOS and Android app.

- [PIEL Survey on the App Store](https://itunes.apple.com/au/app/piel-survey/id1257313392?mt=8)
- [PIEL Survey on Google Play](https://play.google.com/store/apps/details?id=au.com.bluejay.pielsurvey)

The PIEL Survey app is free and used widely in research and therapy contexts. Please consider ["forking"](https://help.github.com/en/articles/fork-a-repo) the project and helping to improve it for all users.

## Code
This web app is written in PHP 7 for an Apache server. This code demonstrates the 2 methods  of delivering surveys to the PIEL Survey app using a web server and does not contain verification of ids or logging. There is also only basic styling and error handling. The code  will need to be customised by end users.

The code does not use any web framework but developers will recognise an MVC design approach. It has been kept simple and modular as we expect developers will want to incorporate this into their own frameworks.

The app demonstrates the download of a PIEL Survey control file by using either POST request or a GET request. This is detected and parsed by `index.php`. The `DownloadController` then handles the download.

## Installation
### Copy Files
In the web root, copy the folder `control-file` and it's contents into the root folder of the web site.

### Code Changes
1. We recommend that you copy all files and folders as they are. If you change folder names or file locations, make sure the paths and URLs in the code are also modified to match your changes.
2. Change the constant `BASE_URL` in `index.php` and the URL to your logo in `customstyle.css` to match your domain.
3. If you want to change the control file, make sure you change the constant `CONTROL_FILE_NAME` in `index.php` to match (do not include the ".survey" extension)

### Server Setup
If your web site uses a content management system or other framework, it is possible that there are rewrite rules in place that will prevent this code working. The directory on which the code is placed may need to be excluded from the rewrites. In many cases, this is found in the `.htaccess` file in the web root. The following code should be placed before the other rewrite code. It will exclude the `control-file` URLs from being redirected.
```ApacheConf
RewriteRule ^(control-file)($|/) - [L]
```
Only experienced developers should do this.

As we don't know your setup, you need to check carefully that this works on your system.

There is a second `.htaccess` file in the `control-file` folder to redirect GET requests to `index.php`. You should not need to touch this.

### Using the app
#### POST Request
Navigate to the following URL (inserting your web domain).
`https://{mydomain.com}/control-file/`

We have set up a [working example here](https://pielsurvey.org/control-file/).

#### GET Request
Enter the URL:
`https://{mydomain.com}/control-file/{survey file}/{id}`

For example, the URL [https://{mydomain.com}/control-file/sample/testid](https://pielsurvey.org/control-file/sample/testid/) will download a sample survey with a participant id of "id".
