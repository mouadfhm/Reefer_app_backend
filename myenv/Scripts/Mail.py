import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import sys
import argparse

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
sender_email = 'mail@gmail.com'
sender_password = 'password'
subject = 'Reefer App - Notification'

parser = argparse.ArgumentParser(description='Process some parameters.')
parser.add_argument('--recipient_email', type=str, required=True, help='The first parameter')
parser.add_argument('--body', type=str, required=True, help='The second parameter')
args = parser.parse_args()
# Access the parameters
recipient_email = args.recipient_email
body = args.body

send_email(sender_email, sender_password, recipient_email, subject, body)
