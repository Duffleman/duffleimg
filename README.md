# duffleimg
Quick file sharing platform. Accepts images, text files, basic files.

This is built on Laravel Lumen, so you need a server to host the images and the server will need to run PHP with some sort of database connection.

It's important to note the image data itself is not stored as a file on the server, but in the database itself as a column. From this, the file itself should be quite small.

When you run this, the shorter your domain is, the better.

*Inspired by starbs/yeh*

## Installation

0. Create a database on a server
0. Upload/deploy code on a server (git/ftp)
0. SSH into the server
0. Copy .env.example to .env
0. Configure the .env file, set the DB connection details and APP_KEY
0. Run `composer install -o --no-dev` on the server
0. Run `php artisan migrate` on the server
0. Open a database editor, alter the `images` table, set the `image` field to `LONGBLOB` instead of just `BLOB` (MySQL)

## API

### `GET /`

Load the GUI for quick uploading images. It will let you drag and drop images and then copy the URL quickly.

### `POST /`

Upload an image to the server. Normally it returns JSON but you can give it an `Accept` header of `text/plain` to get it to just return the URL.

This endpoint requires an `image` which is a normal file upload.

### `GET /{hash}`

Get a specific image previously uploaded

## Test with cURL

`curl -X POST -H "Accept: text/plain" -F "image=@/Users/me/Desktop/file.png" https://urls.net/`

Should return the URL as a text string :)

## Windows

I run ShareX (free download online), and set it as a customer uploader, it'll accept images, files, text. Then you can trigger the screenshot (normally `Ctrl` + `Print Screen`), it'll follow the normal ShareX flow of saving it your disk in the right folder, then uploading it and pasting the URL into your clipboard.

## macOS

Little more complicated, you need Automator, Apple Script Editor, and cURL from your Terminal.

The flow is simple, you tap `Cmd` + `Shift` + `4`. Which normally triggers an interactive screenshot, the configured Accessibility options will instead trigger an Automator script to run the Apple Script which will handle the process.

### Write the Apple Script

Here is my own, please modify as you want.

```
on run
	set {time:t} to current date
	set theFolder to getDate()
	set screenshotFolder to "/Users/duffleman/Pictures/Screenshots/"
	set cmd to "mkdir -p " & screenshotFolder & theFolder
	set theFile to t & ".png"

	do shell script cmd

	set fqfn to screenshotFolder & theFolder & theFile
	set shellCommand to "screencapture -i " & fqfn
	set curlcmd to getCurl(fqfn)

	do shell script shellCommand
	delay 1
	set photoUrl to do shell script curlcmd

	set the clipboard to photoUrl
end run

to getDate()
	set {year:y, month:m, day:d, time:t} to (current date)
	y * 10000
	result + m * 100
	result + d
	result as string

	tell result
		text 1 thru 4
		result & "-"
		result & text 5 thru 6
		result & "-"
		result & text 7 thru 8
	end tell

	result & "/"
end getDate

to getCurl(fqfn)
	set cmd to "curl -X POST -H \"Accept: text/plain\" -F \"image=@" & fqfn & "\" https://{myurl}/"
end getCurl
```

Be careful to replace {myurl} with the URL of your server.

### Automator Configuration

Create a new Automator script as a `Service`, with no input. The script itself is simple, it's just a link to your original script written:

`do shell script "/usr/bin/osascript /Users/duffleman/Documents/screenshot.scpt"`

### Accessibility

In System Preferences, go to "Security & Privacy", then the "Privacy" tab at the top, then down to "Accessibility".

Make sure Automator and the Script Editor are ticked.

Next, go back to System Preferences, then into "Keyboard", then tap "Shortcuts" at the top. On the left panel, go to "Screenshots", and untick the "Save picture of selected area as a file".

Then in the left panel, tap on "Services", scroll to the bottom to find your new "screenshot" service. Assign the proper key-combo to it.

Job done :)
