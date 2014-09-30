<?php if(!defined('KIRBY')) exit ?>

# default blueprint

title: Page
pages: true
files: true
fields:
  seo_title:
    label: Meta Title
    type:  text
  seo_keywords:
    label: Meta Keywords
    type:  text
  seo_description:
    label: Meta Description
    type:  text
  text:
    label: Text
    type:  textarea
    size:  large
filefields:
  caption:
    label: Caption
    type:  text
