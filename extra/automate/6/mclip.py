# python3 mclip.py hello

import sys
import pyperclip

TEXT = {"agree": "Yes, I agree. That sounds fine to me.",
        "busy": "Sorry, can we do this later this week or next week?",
        "upsell": "Would you consider making this a monthly donation"}


def main(keyphrase):
    try:
        if keyphrase in TEXT:
            pyperclip.copy(TEXT[keyphrase])
            print("Text for %s copied to clipboard." % keyphrase)
        else:
            print("There is no text for %s." % keyphrase)
    except Exception as ex:
        print("Oops! Something went wrong:", ex)


if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Usage: python mclip.py [keyphrase] - copy phrase text")
        sys.exit()
    else:
        main(sys.argv[1])
