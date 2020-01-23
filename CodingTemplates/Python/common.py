#!python
# -*- coding: utf-8 -*-

'''
Code common to one or more files.

Python version used: 3.6.8

Styling guide: PEP 8 (https://www.python.org/dev/peps/pep-0008/)
'''

from __future__ import print_function

import datetime
import logging
import os
import re

__author__ = 'Rob Garcia'
__email__ = 'rgarcia@rgprogramming.com'
__license__ = 'MIT'

# Removed Pathlib (redundant) and needed to set PWD to correct
# directory using os
ROOT_DIR = os.path.dirname(__file__)
os.chdir(ROOT_DIR)

# Enable error and exception logging
logging.basicConfig(
    filename='error_log.txt', filemode='a+', level=logging.DEBUG)
# Set to True during development and to False during production
DISPLAY_ERRORS = True


def error_log(exc_info):
    '''
    Reformats error and exception details and records them in plain text in
    the error_log file.
    :param tuple exc_info: Exception details from sys module.
    :returns string: Exception details in plain text.
    '''
    exc_type, exc_value, exc_traceback = exc_info
    local_timezone = datetime.datetime.now(
        datetime.timezone.utc).astimezone().tzinfo
    time_stamp = datetime.datetime.now(
        local_timezone).strftime("%Y-%m-%d %H:%M:%S %Z")
    exception = ("[{}] Type {} Exception: {} in {} at line {}.".format(
        time_stamp,
        exc_type.__name__,
        exc_value,
        exc_traceback.tb_frame.f_code.co_filename,
        exc_traceback.tb_lineno))
    logging.debug(exception)
    return exception


def validateUserID(user_id):
    '''
    Validate UserID.
    :param int user_id: The UserID that will be entered in the database.
    :return bool: True if the UserID is an integer greater than 0, false if not.
    '''
    if not user_id or user_id <= 0:
        return False
    else:
        return True


def validateText(text):
    '''
    Validate text input.
    :param string text: The text that will be entered into the database.
    :return boolean: True if the text is valid, false if not.
    '''
    if not (text.strip()) or re.search("^[A-Za-z0-9\s\-._~:\/?#\[\]@!$&'()*+,;=]*$", text.strip()) is None:
        return False
    else:
        return True


def validateEmail(email):
    '''
    Validate email address.
    :param string email: The email address that will be entered into the database.
    :return boolean: True if the email is valid, false if not.
    '''
    if not (email.strip()) or re.search("^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$", email) is None:
        return False
    else:
        return True


def validateDate(date):
    '''
    Validate date format.
    :param string date: The date that will be entered into the database.
    :return boolean: True if the date format is valid, false if not.
    '''
    r = re.compile('.{4}-.{2}-.{2} .{2}:.{2}:.{2}')
    s = 'xxxx-xx-xx xx:xx:xx'
    if not (date.strip()) or r.match(s) is None or len(s) != 19:
        return False
    else:
        return True
