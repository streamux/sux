{assign var=rootPath value=$skinPathList.root}
{assign var=title value=$groupData.document_name}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="$title :: 사용자 가이드 - STREAMUX"}

사용자가이드 내용 

{include file="$footerPath"}
