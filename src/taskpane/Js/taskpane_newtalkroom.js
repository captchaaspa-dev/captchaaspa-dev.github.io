function create_talk_room()
{
    //alert("Creando sala de talk...");
    console.log("hola mundo!!");

    console.log("accountType:");
    console.log(Office.context.mailbox.userProfile.accountType);

    console.log("displayName:");
    console.log(Office.context.mailbox.userProfile.displayName);

    console.log("emailAddress:");
    console.log(Office.context.mailbox.userProfile.emailAddress);

    console.log("timeZone:");
    console.log(Office.context.mailbox.userProfile.timeZone);

    console.log("timeZone:");
    console.log(Office.context.mailbox.userProfile.timeZone);

    //No se puede usar Office.auth.getAccessToken() si el add-in se llama desde Outlook.com o Gmail.com
    console.log("ssoToken:");
    getSSOToken();
}

function getSSOToken() {
    // 1. Define any necessary options (optional)
    const options = {
        // Force the user to sign in if a valid token isn't available.
        // Usually, the host application (Outlook) handles the sign-in silently.
        allowSignIn: true, 
        
        // This is crucial if you need to exchange the token for a Graph token 
        // that includes specific permissions (scopes).
        // The value is usually an array of Graph scopes, e.g., ["Mail.Send"]
        authChallenge: '' 
    };

    // 2. Call the API to get the token
    Office.auth.getAccessToken(options, function (result) {
        if (result.status === "succeeded") {
            // The token is returned here (JWT format)
            const ssoToken = result.value; 
            
            //return ssoToken;
            console.log(ssoToken);
            
            // 3. Use the token to call your server (or call Graph directly)
            // (See next section)
        } else {
            // Handle errors (e.g., user canceled sign-in, expired token, network error)
            console.error("SSO Token retrieval failed:", result.error);

            //return false;
        }
    });

}

