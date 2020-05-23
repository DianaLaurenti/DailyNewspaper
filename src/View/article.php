<?php $this->layout('layout', ['title' => $this->e($article->getTitle())]) ?>

<h2 style="color:#ff33c1"><?=$this->e($article->getTitle())?></h2>
<h4>di <?=$this->e($article->getAuthor())?></h4>
<p><?=$this->e($article->getContent())?></p>