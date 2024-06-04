import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def send_email(sender_email, sender_password, recipient_email, subject, body):
    # SMTP server configuration
    smtp_server = 'smtp.gmail.com'
    smtp_port = 587

    # Email content
    message = MIMEMultipart()
    message['From'] = sender_email
    message['To'] = recipient_email
    message['Subject'] = subject
    message.attach(MIMEText(body, 'plain'))

    try:
        # Establish a secure connection with the SMTP server
        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()
        
        # Log in to the SMTP server
        server.login(sender_email, sender_password)
        
        # Send the email
        server.send_message(message)
        print('Email sent successfully!')

    except Exception as e:
        print(f'Error sending email: {str(e)}')

    finally:
        # Close the SMTP connection
        server.quit()

# Usage example
sender_email = 'fahimimouad60@gmail.com'
sender_password = 'pwce slqh qcve mwmb'
recipient_email = 'fahimimouad60@gmail.com'
subject = 'Reefer App - Notification'
body = 'This reefer is unplugged and its load time is in more than 4 hours.'

send_email(sender_email, sender_password, recipient_email, subject, body)
