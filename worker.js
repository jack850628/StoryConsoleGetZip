addEventListener("fetch", (event) => {
  event.respondWith(
    handleRequest(event.request).catch(
      (err) => new Response(err.stack, { status: 500 })
    )
  );
});
  
/**
 * Many more examples available at:
 *   https://developers.cloudflare.com/workers/examples
 * @param {Request} request
 * @returns {Promise<Response>}
 */
async function handleRequest(request) {
  const originUrl = new URL(request.headers.get("Origin") || request.url);
  const requestUrl = new URL(request.url);
  const sourceUrl = requestUrl.searchParams.get('url');
  if(!sourceUrl) return new Response("url search param not find.", {status: 404});

  const response = await fetch(encodeURI(sourceUrl),{
    method: request.method, 
    headers: new Headers(request.headers)
  });
  const newResponse = new Response(response.body, response);

  newResponse.headers.set("content-type",'application/zip');
  if(originUrl.host.match(/localhost(:[\d]+)?|jack850628\.github\.io/)){
    newResponse.headers.set("Access-Control-Allow-Origin", originUrl.origin);
  }

  return newResponse;
}
