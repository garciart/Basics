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
