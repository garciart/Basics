#!python
# -*- coding: utf-8 -*-

"""
Code common to one or more files.

Python version used: 3.6.8
SQLite version used: 3.21.0

Styling guide: PEP 8 -- Style Guide for Python Code
    (https://www.python.org/dev/peps/pep-0008/) and
    PEP 257 -- Docstring Conventions
    (https://www.python.org/dev/peps/pep-0257/)
"""

from __future__ import print_function

import datetime
import logging
import os
import re
import sys

# Module metadata dunders
__author__ = "Rob Garcia"
__copyright__ = "Copyright 2019-2020, Rob Garcia"
__email__ = "rgarcia@rgprogramming.com"
__license__ = "MIT"


# Used os instead of os and Pathlib (redundant) to set PWD to correct directory

# Get the application's model directory.
MODEL_DIR = os.path.dirname(__file__)

# To run these functions, switch to the model directory.
os.chdir(MODEL_DIR)

# Enable error and exception logging
logging.basicConfig(
    filename="error_log.txt", filemode="a+", level=logging.DEBUG)
# Set to True during development and to False during production
DISPLAY_ERRORS = True


def log_error(exc_info):
    """Reformats error and exception details and records them in plain text in
        the error_log file.

    :param exc_info: Exception details from sys module.
    :type exc_info: tuple
    :return: Reformated exception details in plain text.
    :rtype: str
    """
    exception = None
    try:
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
    except Exception:
        exc = sys.exc_info()
        # if co.DISPLAY_ERRORS:
        print(exc)
    return exception


def validate_user_id(user_id):
    """Validate UserID.

    :param user_id: The user ID that will be entered in the database.
    :type user_id: int
    :return: True if the user ID is an integer greater than 0, false if not.
    :rtype: bool
    """
    if not user_id or user_id <= 0:
        return False
    else:
        return True


def validate_text(text):
    """Validate text input.

    :param text: The text that will be entered into the database.
    :type text: str
    :return: True if the text is valid, false if not.
    :rtype: bool
    """
    if not (text.strip()) or re.search(
            r"^[A-Za-z0-9 -._~:/?#[\]@!$&'()\*+,;=]*$", text.strip()) is None:
        return False
    else:
        return True


def validate_email(email):
    """Validate email address.

    :param email: The email address that will be entered into the database.
    :type email: str
    :return: True if the email is valid, false if not.
    :rtype: bool
    """
    if not (email.strip()) or re.search(
            r"^[A-Za-z0-9-._~/?#!$&'%*+=`{|}^]+@[A-Za-z0-9.-]+$", email) is None:
        return False
    else:
        return True


def validate_date(date):
    """Validate date format.

    :param date: The date that will be entered into the database.
    :type date: str
    :return: True if the date format is valid, false if not.
    :rtype: bool
    """
    regex = re.compile(".{4}-.{2}-.{2} .{2}:.{2}:.{2}")
    date_format = "xxxx-xx-xx xx:xx:xx"
    if not (date.strip()) or regex.match(date_format) is None or len(date_format) != 19:
        return False
    else:
        return True
