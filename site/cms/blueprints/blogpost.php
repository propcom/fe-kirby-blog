<?php if(!defined('KIRBY')) exit ?>

# blogpost blueprint

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
  frontpage:
    label: Show on frontpage
    type:  checkbox
  tags:
    label: Tags
    type: select
    options:
      Food: Food
      Chefs: Chefs
      Our Shop: Our Shop
      Ingredients: Ingredients
    default: 1
  pub_date:
    label:  Published Date
    type:   date
    format: dd/mm/yy
  text:
    label: Blog Text
    type:  textarea
    size:  large
filefields:
  caption:
    label: Caption
    type:  text
