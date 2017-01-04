{assign var=rootPath value=$skinPathList.root}
{assign var=title value=$groupData.document_name}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="$title :: 다운로드 - STREAMUX"}

다운로드 내용 

{include file="$footerPath"}
