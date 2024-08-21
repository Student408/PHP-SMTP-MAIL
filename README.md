# Mr. Bean's Peculiar Portfolio Contact System

Welcome to the repository for Mr. Bean's Peculiar Portfolio Contact System! This project provides a whimsical yet functional email service for Mr. Bean's portfolio website, perfect for development and testing purposes.

**Live**: [Mr.Bean](https://student408.github.io/Mr.Bean)
          [Mr.Bean](https://mr-bean.pages.dev/)

## 🎭 Overview

This system includes a contact form that sends emails using PHP and SMTP, with client-side handling using JavaScript. It features custom email templates that reflect Mr. Bean's quirky personality.

## ⚠️ Warning

This is a development and testing version. Do not use in production without proper security measures and thorough testing. Mr. Bean would be quite upset if his teddy bear's personal information got leaked!

## 🎈 Features

- Contact form with name, email, and message fields
- SMTP email sending using PHPMailer
- Client-side form handling with loading animation and feedback
- Server-side origin validation for enhanced security
- Customizable email templates with Mr. Bean's unique flair
- Configurable SMTP settings and allowed origins
- Responsive design for various screen sizes

## 🛠 Setup
## get password or create password for email
   ```
  [ https://github.com/Student408/PHP-SMTP-MAIL.git](https://accounts.google.com/v3/signin/challenge/pwd?TL=AKeb6myX4XbQMoCtvB_tHxG3JoMvtaMTMYBIu5Qeli2FMpGfQvzGgMpDYexLz1bl&cid=2&continue=https%3A%2F%2Fmyaccount.google.com%2Fapppasswords&flowName=GlifWebSignIn&followup=https%3A%2F%2Fmyaccount.google.com%2Fapppasswords&ifkv=Ab5oB3oE4jlnbv398SGnl0oS7YROzUYhEktYe5fWKfqgwaRENatUvNNt0n5MkVqh6qUnHUW2gSUNxA&osid=1&rart=ANgoxcc4x56MayCrzrDeSN9ltZxXfchXOMX9h5xjW3Zss0lcSJGWkiZnNsdptnuVdVZbsuQPmfu76ghr9RLtmWprdGU_3eLNakoTTjt8eEGg2VKCQYv1OMM&rpbg=1&service=accountsettings)
   ```

1. Clone this repository faster than Mr. Bean can get into trouble:

   ```
   https://github.com/Student408/PHP-SMTP-MAIL.git
   ```
2. Navigate to the project directory:

   ```
   cd PHP-SMTP-MAIL
   ```
3. Configure your SMTP settings and allowed origins in `config.php`:

   ```php
   return [
       'smtp' => [
           'username' => 'mr.bean@example.com',
           'password' => 'your_secure_password',
           'host' => 'smtp.gmail.com',
           'port' => 587,
           'encryption' => 'tls',
       ],
       'receiver' => [
           'email' => 'mr.bean.receiver@example.com',
           'name' => 'Mr. Bean',
       ],
       'allowed_origins' => [
           'http://localhost',
           'https://mr.bean.example.com',
           'http://127.0.0.1',
           'http://127.0.0.1:5500'
       ],
   ];
   ```
4. Update the fetch URL in `email.js` to point to your `send_email.php` file:

   ```javascript
   fetch('https://yourwebsite.com/send_email.php', {
       // ...
   })
   ```
5. Customize the email templates in the `email_template` directory:

   - `acknowledgement_email.html`: Sent to the person contacting Mr. Bean
   - `receiver_notification.html`: Sent to Mr. Bean (or his assistant)

## 🎬 Usage

1. Host the files on a PHP-enabled web server.
2. Open `index.html` in a web browser.
3. Fill out the contact form with a name sillier than Mr. Bean's and submit it to test the email functionality.
4. Watch for the loading animation and feedback message.

## 📁 File Structure

- `config.php`: Configuration file for SMTP settings and allowed origins
- `email.js`: Client-side JavaScript for form handling and AJAX submission
- `index.html`: HTML file containing the contact form and portfolio structure
- `send_email.php`: Server-side PHP script for processing form submissions and sending emails
- `smtp/`: Directory containing PHPMailer files
- `email_template/`:
  - `acknowledgement_email.html`: Template for the auto-reply sent to the contactor
  - `receiver_notification.html`: Template for the notification sent to Mr. Bean

## 🔒 Security Notes

- This project includes basic origin validation, but additional security measures should be implemented for production use. Mr. Bean takes security seriously (when he remembers to)!
- SMTP credentials are stored in plain text in `config.php`. Use environment variables or other secure methods to store sensitive information in a production environment.
- Implement proper input validation and sanitization before using in a production environment. We don't want any mischief-makers sending Mr. Bean spam!

## 🧸 Email Templates

### Acknowledgement Email

The `acknowledgement_email.html` template features:

- A whimsical greeting from Mr. Bean
- A teddy bear icon
- Playful message acknowledging receipt of the contact form submission
- Social media links (GitHub and Buy Me a Coffee)
- Mr. Bean's signature

### Receiver Notification

The `receiver_notification.html` template includes:

- Clear "New Contact Message" header
- Formatted display of sender's name and email
- Full message content
- Footer indicating the source of the message

## 🛜 Dependencies

- [PHPMailer](https://github.com/PHPMailer/PHPMailer): For sending emails via SMTP with the reliability of a well-oiled Mr. Bean scheme. This is already included in the project's `smtp` directory.

## 🤝 Contributing

Feel free to fork this repository and submit pull requests for any improvements or bug fixes. Mr. Bean appreciates all help, as long as it doesn't involve parallel parking!

## 📜 License

[MIT License](LICENSE) (Mr. Bean had to look up what MIT stood for)

## 📬 Contact

For any questions, concerns, or to share your favorite Mr. Bean moment, please open an issue on this GitHub repository.

## 🎨 Customization

Feel free to adjust the colors, fonts, and layout of the email templates and contact form to match Mr. Bean's unique style. Just remember, less is sometimes more (unless we're talking about teddy bears).

## 🌐 Social Links

- [GitHub](https://github.com/Student408)
- [LinkedIn](https://www.linkedin.com/in/ranjanshettigar/)
- [Twitter](https://x.com/lokotwiststudio)
- [LinkTree](https://linktr.ee/THE.LOKO?subscribe)

---

Remember: In the world of coding, be as resourceful as Mr. Bean, as precise as his straightening of picture frames, and always keep a sense of humor!
