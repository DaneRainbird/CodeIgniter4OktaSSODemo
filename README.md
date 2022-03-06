# CodeIgniter 4 Okta Open ID Connect (OIDC) Demo

A demonstration of Okta-powered OIDC authentication for CodeIgniter 4.

## Features
 - Okta-powered sign in
 - Support for redirect on login (not utilised in this demo;  see the `callback()` function within `Users.php` for more details

## Prerequisites

Firstly, make a copy of the `.env.example` file and name it `.env`. Ensure this file is in the root of the directory. 

Secondly, an Okta Application needs to be generated:
 - Register for an Okta account on the [Okta Developer Portal](https://developer.okta.com/signup/) (or sign in)
 - Navigate to `Applications > Applications` in the menu after signing in
 - Select `Create App Integreation`
 - Choose `OIDC - OpenID Connect` and `Web Application`
 - Select `Next` and follow the prompts to name your Okta app
 - Ensure that your `Sign-in redirect URIs` value is set to `http://localhost:8080/users/callback`
 - Once the app is generated, copy the `Client ID` and `Client Secret` values into your `.env` file (following the layout in `.env.example`)

Once completed, your `.env` file should look like the following:
```
okta.baseUrl = http://localhost:8080
okta.redirectUrl = http://localhost:8080/users/callback
okta.clientId = [YOUR_OKTA_CLIENT_ID]
okta.clientSecret = [YOUR_OKTA_CLIENT_SECRET]
okta.metadataUrl = https://[YOUR_OKTA_DOMAIN]/oauth2/default/.well-known/oauth-authorization-server
```

## Running
To run locally:
 - Open a Terminal of choice to your working directory 
 - Run the command `php spark serve`
 - Navigate to localhost:8080 in your browser

To run on a hosted environment:
 - Follow [the instructions in the CodeIgniter 4 Docs](https://codeigniter.com/user_guide/installation/running.html)

## Technical Details
This demo is mostly powered by the `OktaService`, found within `App/Services` to handle communication with Okta itself, whilst the `Users` controller handles calling the `OktaService`.

For this example, `OktaService` only requests the `openid` and `email` scopes from Okta, but this can be expanded upon by editing the `buildAuthorizeUrl()` function (provided that your Okta Application has the correct scope permissions).

Details of logged in users are stored within [CodeIgniter's Session object](https://codeigniter.com/user_guide/libraries/sessions.html), and as such the current authentication status of a given session can be confirmed by checking the return value of `session()->get('username');`

## Disclaimer
This project was inspired by the [Simple, Secure Authentication with CodeIgniter](https://developer.okta.com/blog/2019/10/28/simple-secure-authentication-with-codeigniter) tutorial, written by Krasimir Hristozov for Okta.

Krasimir's repo was written in 2019, and was for CodeIgniter3. As CodeIgniter 4 is a complete overhaul of CodeIgniter (closer to a rewrite than an update), the code provided in the tutorial is now out of date, and requires some tinkering.
