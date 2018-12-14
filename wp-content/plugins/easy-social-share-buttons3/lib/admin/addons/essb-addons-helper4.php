<?php
//
class ESSBAddonsHelper {

	private $cache_options_slug = "essb3_addons";
	private $announced_addons_slug = "essb3_addons_announce";
	private $update_addons_server = "http://extensions.appscreo.com/4/"; //"http://addons.appscreo.com";

	private $base_addons = 'eyJlc3NiLXRlbXBsYXRlcy1yYWluYm93Ijp7InNsdWciOiJlc3NiLXRlbXBsYXRlcy1yYWluYm93IiwibmFtZSI6IlJhaW5ib3cgVGVtcGxhdGVzIFBhY2siLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL3JhaW5ib3ctdGVtcGxhdGVzLnBuZyIsImRlc2NyaXB0aW9uIjoiNjAgYXdlc29tZSBsb29raW5nIGdyYWRpZW50IHRlbXBsYXRlcyBmb3IgRWFzeSBTb2NpYWwgU2hhcmUgQnV0dG9ucyBmb3IgV29yZFByZXNzIiwicHJpY2UiOiIkMTAiLCJwYWdlIjoiaHR0cHM6XC9cL2NvZGVjYW55b24ubmV0XC9pdGVtXC9yYWluYm93LXRlbXBsYXRlcy1wYWNrLWZvci1lYXN5LXNvY2lhbC1zaGFyZS1idXR0b25zXC8yMjc1MzU0MSIsImRlbW9fdXJsIjoiaHR0cHM6XC9cL3NvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC9yYWluYm93LXRlbXBsYXRlcy1wYWNrXC8iLCJjaGVjayI6IiIsImNoZWNrX2Z1bmN0aW9uIjoiZXNzYl9yYWluYm93X2luaXRpYWx6ZSIsInRhZ3MiOiJ1bmlxdWUiLCJjYXRlZ29yeSI6InRlbXBsYXRlcyIsInJlcXVpcmVzIjoiNS4wIiwiZmlsdGVycyI6InRlbXBsYXRlcyxwYWlkLG5ldyJ9LCJlc3NiLWN1c3RvbS10ZW1wbGF0ZS1idWlsZGVyIjp7InNsdWciOiJlc3NiLWN1c3RvbS10ZW1wbGF0ZS1idWlsZGVyIiwibmFtZSI6IkN1c3RvbSBUZW1wbGF0ZSBCdWlsZGVyIGZvciBTb2NpYWwgU2hhcmUgQnV0dG9ucyIsImltYWdlIjoiaHR0cDpcL1wvYWRkb25zLmFwcHNjcmVvLmNvbVwvaVwvZXh0ZW5zaW9ucy0wMS5wbmciLCJkZXNjcmlwdGlvbiI6IkVhc3kgYnVpbGQgd2l0aCB2aXN1YWwgb3B0aW9ucyBhIGN1c3RvbSB0ZW1wbGF0ZSBmb3Igc29jaWFsIHNoYXJpbmcgYnV0dG9ucyBpbnRlZ3JhdGVkIGludG8gcGx1Z2luIGFuZCB1c2VkIGFsb25nIHdpdGggdGhlIGRlZmF1bHQiLCJwcmljZSI6IkZSRUUiLCJwYWdlIjoiaHR0cDpcL1wvZ2V0LnNvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8/ZG93bmxvYWQ9ZXNzYi1jdXN0b20tdGVtcGxhdGUtYnVpbGRlciIsImRlbW9fdXJsIjoiIiwiY2hlY2siOiJFU1NCX1NCVEJfVkVSU0lPTiIsInRhZ3MiOiJ1bmlxdWUiLCJjYXRlZ29yeSI6InRlbXBsYXRlcyIsInJlcXVpcmVzIjoiNS4xLjQiLCJmaWx0ZXJzIjoidGVtcGxhdGVzLGZyZWUsbmV3In0sImVzc2ItbXVsdGlzdGVwLXNoYXJlcmVjb3ZlcnkiOnsic2x1ZyI6ImVzc2ItbXVsdGlzdGVwLXNoYXJlcmVjb3ZlcnkiLCJuYW1lIjoiTXVsdGktc3RlcCBTaGFyZSBDb3VudGVyIFJlY292ZXJ5IiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA1LnBuZyIsImRlc2NyaXB0aW9uIjoiSW5jbHVkZSBhZGRpdGlvbmFsIHJlY292ZXJ5IHJ1bGVzIHRoYXQgY2FuIGJlIHVzZWQgaWYgeW91IGhhdmUgbWFkZSBhZGRpdGlvbmFsIGNoYW5nZXMgaW4gdGhlIHBhc3QgLSB1cCB0byAzIGFkZGl0aW9uYWwgcmVjb3ZlcnkgcnVsZXMgaW4gaGVscCBvZiB0aGUgcHJpbWFyeSIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLW11bHRpc3RlcC1zaGFyZXJlY292ZXJ5IiwiZGVtb191cmwiOiIiLCJjaGVjayI6IkVTU0JfTVNTUl9WRVJTSU9OIiwidGFncyI6InVuaXF1ZSIsImNhdGVnb3J5IjoiZnVuY3Rpb24iLCJyZXF1aXJlcyI6IjUuMS4zIiwiZmlsdGVycyI6ImZ1bmN0aW9uLGZyZWUsbmV3In0sImVzc2ItYmltYmVyLWV4dGVuc2lvbiI6eyJzbHVnIjoiZXNzYi1iaW1iZXItZXh0ZW5zaW9uIiwibmFtZSI6IkRpc3BsYXkgTWV0aG9kOiBCaW1iZXIgVGhlbWUgU2hhcmUgQnV0dG9ucyBSZXBsYWNlIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA2LnBuZyIsImRlc2NyaXB0aW9uIjoiSW5jbHVkZSByZXBsYWNlbWVudCBvZiBkZWZhdWx0IHRoZW1lIHNoYXJlIGJ1dHRvbnMgd2l0aCBFYXN5IFNvY2lhbCBTaGFyZSBCdXR0b25zICh0aGVtZSBzcGVjaWZpYyBmdW5jdGlvbnMpIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItYmltYmVyLWV4dGVuc2lvbiIsImRlbW9fdXJsIjoiIiwiY2hlY2siOiJFU1NCX0JJTUJFUl9SRVBMQUNFIiwidGFncyI6Im5ldyIsImNhdGVnb3J5IjoiaW50ZWdyYXRpb24iLCJyZXF1aXJlcyI6IjQuMS44IiwiZmlsdGVycyI6ImRpc3BsYXksbmV3LGZyZWUsaW50ZWdyYXRpb24ifSwiZXNzYi1kaXNwbGF5LXdvb2NvbW1lcmNldGhhbmt5b3UiOnsic2x1ZyI6ImVzc2ItZGlzcGxheS13b29jb21tZXJjZXRoYW5reW91IiwibmFtZSI6IkRpc3BsYXkgTWV0aG9kOiBXb29Db21tZXJjZSBUaGFuayBZb3UgUGFnZSBTaGFyZSBQcm9kdWN0cyIsImltYWdlIjoiaHR0cDpcL1wvYWRkb25zLmFwcHNjcmVvLmNvbVwvaVwvZXh0ZW5zaW9ucy0wMy5wbmciLCJkZXNjcmlwdGlvbiI6IkFkZCBsaXN0IG9mIHB1cmNoYXNlZCBwcm9kdWN0cyB3aXRoIHNoYXJlIGJ1dHRvbnMgb24geW91ciBXb29Db21tZXJjZSB0aGFuayB5b3UgYWZ0ZXIgcHVyY2hhc2UgcGFnZSIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLWRpc3BsYXktd29vY29tbWVyY2V0aGFua3lvdSIsImRlbW9fdXJsIjoiaHR0cHM6XC9cL3NvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC81MC1zb2NpYWwtbmV0d29ya3Mtc3BlY2lhbC1idXR0b25zXC8iLCJjaGVjayI6IkVTU0JfRE1fV1RCX1BMVUdJTl9ST09UIiwidGFncyI6Im5ldyIsImNhdGVnb3J5Ijoid29vY29tbWVyY2UiLCJyZXF1aXJlcyI6IjQuMS44IiwiZmlsdGVycyI6ImRpc3BsYXksbmV3LGZyZWUsd29vY29tbWVyY2UifSwiZXNzYi1leHRlbmRlZC1idXR0b25zLXBhY2siOnsic2x1ZyI6ImVzc2ItZXh0ZW5kZWQtYnV0dG9ucy1wYWNrIiwibmFtZSI6IlNvY2lhbCBOZXR3b3JrczogRXh0ZW5kZWQgU29jaWFsIE5ldHdvcmtzIFBhY2siLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2V4dGVuc2lvbnMtMDIucG5nIiwiZGVzY3JpcHRpb24iOiJOZXR3b3JrczogSGF0ZW5hLCBEb3ViYW4sIFRlbmNlbnQgUVEsIE5hdmVyLCBSZW5yZW4iLCJwcmljZSI6IkZSRUUiLCJwYWdlIjoiaHR0cDpcL1wvZ2V0LnNvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8/ZG93bmxvYWQ9ZXNzYi1leHRlbmRlZC1idXR0b25zLXBhY2siLCJkZW1vX3VybCI6Imh0dHBzOlwvXC9zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvNTAtc29jaWFsLW5ldHdvcmtzLXNwZWNpYWwtYnV0dG9uc1wvIiwiY2hlY2siOiJFU1NCX0VQX1JPT1QiLCJ0YWdzIjoibmV3IiwiY2F0ZWdvcnkiOiJzb2NpYWwgbmV0d29ya3MiLCJyZXF1aXJlcyI6IjQuMS44IiwiZmlsdGVycyI6Im5ldHdvcmtzLGZyZWUifSwiZXNzYi1mdW5jdGlvbmFsLWJ1dHRvbnMtcGFjayI6eyJzbHVnIjoiZXNzYi1mdW5jdGlvbmFsLWJ1dHRvbnMtcGFjayIsIm5hbWUiOiJTb2NpYWwgTmV0d29ya3M6IEZ1bmN0aW9uYWwgU2hhcmUgQnV0dG9ucyBQYWNrIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTAyLnBuZyIsImRlc2NyaXB0aW9uIjoiSW5jbHVkZSB1c2FnZSBvZiBmdW5jdGlvbmFsIGJ1dHRvbnMgc2V0OiBQcmV2aW91cyBQb3N0LCBOZXh0IFBvc3QsIENvcHkgTGluaywgQm9va21hcmssIFFSIENvZGUgR2VuZXJhdG9yIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItZnVuY2l0b25hbC1idXR0b25zLXBhY2siLCJkZW1vX3VybCI6Imh0dHBzOlwvXC9zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvNTAtc29jaWFsLW5ldHdvcmtzLXNwZWNpYWwtYnV0dG9uc1wvIiwiY2hlY2siOiJFU1NCX0ZQX1JPT1QiLCJ0YWdzIjoibmV3IiwiY2F0ZWdvcnkiOiJzb2NpYWwgbmV0d29ya3MiLCJyZXF1aXJlcyI6IjQuMS44IiwiZmlsdGVycyI6Im5ldHdvcmtzLGZyZWUifSwiZXNzYi1vcHRpbi1mbHlvdXQiOnsic2x1ZyI6ImVzc2Itb3B0aW4tZmx5b3V0IiwibmFtZSI6Ik9wdC1pbiBGbHlvdXQgQWRkLW9uIGZvciBFYXN5IFNvY2lhbCBTaGFyZSBCdXR0b25zIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA0LnBuZyIsImRlc2NyaXB0aW9uIjoiRGlzcGxheSBmbHlvdXQgb3B0LWluIGZvcm1zIGJhc2VkIG9uIHZhcmlvdXMgY29uZGl0aW9uczogdGltZSBkZWxheSwgc2Nyb2xsIG9yIGV4aXQgaW50ZW50IGFuZCBpbmNyZWFzZSB5b3VyIHN1YnNjcmliZXJzLiIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLW9wdGluLWZseW91dCIsImRlbW9fdXJsIjoiIiwiY2hlY2siOiJFU1NCM19PRk9GX1ZFUlNJT04iLCJ0YWdzIjoibmV3IiwiY2F0ZWdvcnkiOiJzdWJzY3JpYmUgZXh0ZW5zaW9uIiwicmVxdWlyZXMiOiI0LjAuMyIsImZpbHRlcnMiOiJzdWJzY3JpYmUsZnJlZSJ9LCJlc3NiLWJlYXZlcmJ1aWxkZXItdGhlbWUtaW50ZWdyYXRpb24iOnsic2x1ZyI6ImVzc2ItYmVhdmVyYnVpbGRlci10aGVtZS1pbnRlZ3JhdGlvbiIsIm5hbWUiOiJEaXNwbGF5IE1ldGhvZDogQmVhdmVyIEJ1aWxkZXIgVGhlbWUgSW50ZWdyYXRpb24iLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2V4dGVuc2lvbnMtMDYucG5nIiwiZGVzY3JpcHRpb24iOiJDdXN0b20gZGlzcGxheSBwb3NpdGlvbnMgZm9yIEJlYXZlciBCdWlsZGVyIFRoZW1lOiBCZWZvcmVcL0FmdGVyIGNvbnRlbnQiLCJwcmljZSI6IkZSRUUiLCJwYWdlIjoiaHR0cDpcL1wvZ2V0LnNvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8/ZG93bmxvYWQ9ZXNzYi1iZWF2ZXJidWlsZGVyLXRoZW1lLWludGVncmF0aW9uIiwiZGVtb191cmwiOiIiLCJjaGVjayI6IkVTU0JfQkJUX0NVU1RPTV9CT0lMRVJQTEFURSIsInRhZ3MiOiJuZXciLCJjYXRlZ29yeSI6ImludGVncmF0aW9uIiwicmVxdWlyZXMiOiI0LjAuMiIsImZpbHRlcnMiOiJkaXNwbGF5LGludGVncmF0aW9uLGZyZWUifSwiZXNzYi12aWRlby1zaGFyZS1ldmVudHMiOnsic2x1ZyI6ImVzc2ItdmlkZW8tc2hhcmUtZXZlbnRzIiwibmFtZSI6IlZpZGVvIFNoYXJpbmcgQWRkLW9uIGZvciBFYXN5IFNvY2lhbCBTaGFyZSBCdXR0b25zIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9hZGRvbl9pbWFnZXM0LTExLnBuZyIsImRlc2NyaXB0aW9uIjoiQSBtdXN0IGhhdmUgdG9vbCBmb3IgZWFjaCB2aWRlbyBtYXJrZXRpbmcgY2FtcGFpZ24uIEFkZCBiZWF1dGlmdWwgY2FsbCB0byBhY3Rpb25zIG9uIHNwZWNpZmljIGV2ZW50cyB0byBpbmNyZWFzZSB5b3VyIHNvY2lhbCBzaGFyZXMsIHNvY2lhbCBmb2xsb3dpbmcsIG1haWxpbmcgbGlzdCwgeW91ciBtYXJrZXRpbmcgbWVzc2FnZSBhdCB0aGUgcmlnaHQgdGltZSBvciBqdXN0IHNoYXJlIGJ1dHRvbnMuIiwicHJpY2UiOiIkMTQiLCJwYWdlIjoiaHR0cHM6XC9cL2NvZGVjYW55b24ubmV0XC9pdGVtXC92aWRlby1zaGFyaW5nLWFkZG9uLWZvci1lYXN5LXNvY2lhbC1zaGFyZS1idXR0b25zXC84NDM0NDY3IiwiZGVtb191cmwiOiJodHRwOlwvXC9wcmV2aWV3LmNvZGVjYW55b24ubmV0XC9pdGVtXC92aWRlby1zaGFyaW5nLWFkZG9uLWZvci1lYXN5LXNvY2lhbC1zaGFyZS1idXR0b25zXC9mdWxsX3NjcmVlbl9wcmV2aWV3XC84NDM0NDY3IiwiY2hlY2siOiJFU1NCM19WU0VfVkVSU0lPTiIsInRhZ3MiOiIiLCJjYXRlZ29yeSI6InZpZGVvIHNoYXJpbmciLCJyZXF1aXJlcyI6IjQuMCIsImZpbHRlcnMiOiJ2aWRlbyxmdW5jdGlvbixwYWlkIn0sImVzc2Itb3B0aW4tYm9vc3RlciI6eyJzbHVnIjoiZXNzYi1vcHRpbi1ib29zdGVyIiwibmFtZSI6Ik9wdC1pbiBCb29zdGVyIEFkZC1vbiBmb3IgRWFzeSBTb2NpYWwgU2hhcmUgQnV0dG9ucyIsImltYWdlIjoiaHR0cDpcL1wvYWRkb25zLmFwcHNjcmVvLmNvbVwvaVwvZXh0ZW5zaW9ucy0wNC5wbmciLCJkZXNjcmlwdGlvbiI6IkRpc3BsYXkgb3B0LWluIGZvcm1zIGJhc2VkIG9uIHZhcmlvdXMgY29uZGl0aW9uczogdGltZSBkZWxheSwgc2Nyb2xsIG9yIGV4aXQgaW50ZW50IGFuZCBpbmNyZWFzZSB5b3VyIHN1YnNjcmliZXJzLiIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLW9wdGluLWJvb3N0ZXIiLCJkZW1vX3VybCI6IiIsImNoZWNrIjoiRVNTQjNfT0ZPQl9WRVJTSU9OIiwidGFncyI6IiIsImNhdGVnb3J5Ijoic3Vic2NyaWJlIGV4dGVuc2lvbiIsInJlcXVpcmVzIjoiNC4wLjMiLCJmaWx0ZXJzIjoic3Vic2NyaWJlLGZyZWUifSwiZXNzYi10ZW1wbGF0ZS1jaHJpc3RtYXMiOnsic2x1ZyI6ImVzc2ItdGVtcGxhdGUtY2hyaXN0bWFzIiwibmFtZSI6IlRlbXBsYXRlczogQ2hyaXN0bWFzIHBhY2siLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2V4dGVuc2lvbnMtMDEucG5nIiwiZGVzY3JpcHRpb24iOiJQcmVwYXJlIHlvdXIgc2l0ZSBmb3IgdXBjb21pbmcgQ2hyaXN0bWFzIGFuZCBOZXcgWWVhciB3aXRoIHR3byBzcGVjaWFsIENocmlzdG1hcyB0ZW1wbGF0ZXMiLCJwcmljZSI6IkZSRUUiLCJwYWdlIjoiaHR0cDpcL1wvZ2V0LnNvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8/ZG93bmxvYWQ9ZXNzYi10ZW1wbGF0ZS1jaHJpc3RtYXMiLCJkZW1vX3VybCI6IiIsImNoZWNrIjoiRVNTQl9URU1QTEFURVBBQ0tfQ0hSSVNUTUFTIiwidGFncyI6IiIsImNhdGVnb3J5IjoidGVtcGxhdGVzIiwicmVxdWlyZXMiOiI0LjAuMiIsImZpbHRlcnMiOiJ0ZW1wbGF0ZSxmcmVlIn0sImVzc2ItZGlzcGxheS13b29jb21tZXJjZWJhciI6eyJzbHVnIjoiZXNzYi1kaXNwbGF5LXdvb2NvbW1lcmNlYmFyIiwibmFtZSI6IkRpc3BsYXkgTWV0aG9kOiBXb29Db21tZXJjZSBCYXIiLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2V4dGVuc2lvbnMtMDMucG5nIiwiZGVzY3JpcHRpb24iOiJTcGVjaWFsIGRlc2lnbmVkIHNoYXJlIGJhciBmb3IgV29vQ29tbWVyY2Ugc3RvcmVzIHdpdGggc2hhZXIgYnV0dG9ucywgcHJvZHVjdCB0aXRsZVwvcHJpY2UgYW5kIGJ1eSBub3cgYnV0dG9uIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItZGlzcGxheS13b29jb21tZXJjZWJhciIsImRlbW9fdXJsIjoiaHR0cHM6XC9cL3NvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC9wcm9kdWN0XC9mbHlpbmctbmluamFcLz9wb3NpdGlvbl9kZW1vPXdvb2JhciIsImNoZWNrIjoiRVNTQl9ETV9WUF9QTFVHSU5fVVJMIiwidGFncyI6IiIsImNhdGVnb3J5Ijoid29vY29tbWVyY2UiLCJyZXF1aXJlcyI6IjQuMC4yIiwiZmlsdGVycyI6ImRpc3BsYXksZnJlZSx3b29jb21tZXJjZSJ9LCJlc3NiLWRpc3BsYXktdmlyYWxwb2ludCI6eyJzbHVnIjoiZXNzYi1kaXNwbGF5LXZpcmFscG9pbnQiLCJuYW1lIjoiRGlzcGxheSBNZXRob2Q6IFZpcmFsIFBvaW50IiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTAzLnBuZyIsImRlc2NyaXB0aW9uIjoiU3VwZXIgY29vbCBzaGFyZSBwb2ludCBkZXNpZ24gd2l0aCBhdXRvbWF0aWMgdHJpZ2dlciBvbiBob3ZlciwgZXllIGNhdGNoaW5nIGRlc2lnbiBhbmQgYW5pbWF0aW9ucyIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLWRpc3BsYXktdmlyYWxwb2ludCIsImRlbW9fdXJsIjoiaHR0cHM6XC9cL3NvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8yNy1kaXNwbGF5LXBvc2l0aW9uc1wvP3Bvc2l0aW9uX2RlbW89dmlyYWxwb2ludCIsImNoZWNrIjoiRVNTQl9ETV9WUF9QTFVHSU5fVVJMIiwidGFncyI6IiIsImNhdGVnb3J5IjoiZGlzcGxheSBtZXRob2QiLCJyZXF1aXJlcyI6IjQuMC4yIiwiZmlsdGVycyI6ImRpc3BsYXksZnJlZSJ9LCJlc3NiLWRpc3BsYXktc3VwZXJwb3N0ZmxvYXQiOnsic2x1ZyI6ImVzc2ItZGlzcGxheS1zdXBlcnBvc3RmbG9hdCIsIm5hbWUiOiJEaXNwbGF5IE1ldGhvZDogU3VwZXIgUG9zdCBGbG9hdCIsImltYWdlIjoiaHR0cDpcL1wvYWRkb25zLmFwcHNjcmVvLmNvbVwvaVwvZXh0ZW5zaW9ucy0wMy5wbmciLCJkZXNjcmlwdGlvbiI6IkV4dGVuZGVkIHZlcnNpb24gb2YgcG9zdCB2ZXJ0aWNhbCBmbG9hdCB3aXRoIGNhbGwgdG8gYWN0aW9uIG1lc3NhZ2UgYW5kIGRpc3BsYXkgb2YgdG90YWxcL2NvbW1lbnRzIGNvdW50IiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItZGlzcGxheS1zdXBlcnBvc3RmbG9hdCIsImRlbW9fdXJsIjoiaHR0cHM6XC9cL3NvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8yNy1kaXNwbGF5LXBvc2l0aW9uc1wvP3Bvc2l0aW9uX2RlbW89c3VwZXJwb3N0ZmxvYXQiLCJjaGVjayI6IkVTU0JfRE1fU1BGX1BMVUdJTl9VUkwiLCJ0YWdzIjoiIiwiY2F0ZWdvcnkiOiJkaXNwbGF5IG1ldGhvZCIsInJlcXVpcmVzIjoiNC4wLjIiLCJmaWx0ZXJzIjoiZGlzcGxheSxmcmVlIn0sImVzc2ItZGlzcGxheS1zdXBlcnBvc3RiYXIiOnsic2x1ZyI6ImVzc2ItZGlzcGxheS1zdXBlcnBvc3RiYXIiLCJuYW1lIjoiRGlzcGxheSBNZXRob2Q6IFN1cGVyIFBvc3QgQmFyIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTAzLnBuZyIsImRlc2NyaXB0aW9uIjoiRXh0ZW5kIHlvdXIgYm90dG9tIGRpc3BsYXkgbWV0aG9kIHdpdGggc3VwZXIgcG9zdCBiYXIuIFN1cGVyIHBvc3QgYmFyIGFsbG93cyBkaXNwbGF5IG9mIHByZXZpb3VzXC9uZXh0IHBvc3QgdG9vLiIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLWRpc3BsYXktc3VwZXJwb3N0YmFyIiwiZGVtb191cmwiOiJodHRwczpcL1wvc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLzI3LWRpc3BsYXktcG9zaXRpb25zXC8/cG9zaXRpb25fZGVtbz1zdXBlcnBvc3RiYXIiLCJjaGVjayI6IkVTU0JfRE1fU1BCX1BMVUdJTl9VUkwiLCJ0YWdzIjoiIiwiY2F0ZWdvcnkiOiJkaXNwbGF5IG1ldGhvZCIsInJlcXVpcmVzIjoiNC4wLjIiLCJmaWx0ZXJzIjoiZGlzcGxheSxmcmVlIn0sImVzc2ItZGlzcGxheS1tb2JpbGUtc2hhcmViYXJjdGEiOnsic2x1ZyI6ImVzc2ItZGlzcGxheS1tb2JpbGUtc2hhcmViYXJjdGEiLCJuYW1lIjoiRGlzcGxheSBNZXRob2Q6IE1vYmlsZSBTaGFyZSBCYXIgd2l0aCBDYWxsIHRvIEFjdGlvbiBCdXR0b24iLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2V4dGVuc2lvbnMtMDMucG5nIiwiZGVzY3JpcHRpb24iOiJJbmNsdWRlIG1vYmlsZSBzaGFyZSBiYXIgd2l0aCBjdXN0b20gY2FsbCB0byBhY3Rpb24gYnV0dG9uIG5leHQgdG8gc2hhcmUgYnV0dG9uLiIsInByaWNlIjoiRlJFRSIsInBhZ2UiOiJodHRwOlwvXC9nZXQuc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLz9kb3dubG9hZD1lc3NiLWRpc3BsYXktbW9iaWxlLXNoYXJlYmFyY3RhIiwiZGVtb191cmwiOiJodHRwczpcL1wvc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cLzI3LWRpc3BsYXktcG9zaXRpb25zXC8/cG9zaXRpb25fZGVtbz1tb2JpbGU3IiwiY2hlY2siOiJFU1NCX0RNX01TQkNUQV9QTFVHSU5fVVJMIiwidGFncyI6IiIsImNhdGVnb3J5IjoiZGlzcGxheSBtZXRob2QiLCJyZXF1aXJlcyI6IjQuMC4yIiwiZmlsdGVycyI6ImRpc3BsYXksZnJlZSJ9LCJlc3NiLXN1YnNjcmliZS1jb25uZWN0b3ItamV0cGFjayI6eyJzbHVnIjoiZXNzYi1zdWJzY3JpYmUtY29ubmVjdG9yLWpldHBhY2siLCJuYW1lIjoiT3B0LWluIENvbm5lY3RvcjogSmV0UGFjayBTdWJzY3JpcHRpb25zIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA0LnBuZyIsImRlc2NyaXB0aW9uIjoiQWN0aXZhdGUgdXNhZ2Ugb2YgSmV0UGFjayBTdWJzY3JpcHRpb25zIGluIE9wdC1pbiBNb2R1bGUiLCJwcmljZSI6IkZSRUUiLCJwYWdlIjoiaHR0cDpcL1wvZ2V0LnNvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8/ZG93bmxvYWQ9ZXNzYi1zdWJzY3JpYmUtY29ubmVjdG9yLWpldHBhY2siLCJkZW1vX3VybCI6IiIsImNoZWNrIjoiRVNTQl9TVUJTQ1JJQkVfQ09OTkVDVE9SX0pFVFBBQ0siLCJ0YWdzIjoiIiwiY2F0ZWdvcnkiOiJzdWJzY3JpYmUgZm9ybXMiLCJyZXF1aXJlcyI6IjQuMC4yIiwiZmlsdGVycyI6InN1YnNjcmliZSxmcmVlIn0sImVzc2Itc29jaWFsLWFiIjp7InNsdWciOiJlc3NiLXNvY2lhbC1hYiIsIm5hbWUiOiJTb2NpYWwgQVwvQiBWaXN1YWwgVGVzdHMgQWRkLW9uIGZvciBFYXN5IFNvY2lhbCBTaGFyZSBCdXR0b25zIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA1LnBuZyIsImRlc2NyaXB0aW9uIjoiSXQgd2FzIG5ldmVyIGJlZW4gc28gZWFzeSB0byBmaW5kIHdoYXQgd29ya3MgYmVzdCBmb3IgeW91ciBzaXRlLiBTZXR1cCB1cCB0byAzIGRpZmZlcmVudCBjb25maWd1cmF0aW9ucyBvZiBidXR0b25zIG9uIHlvdXIgc2l0ZSBhbmQgcnVuIHRoZSB0ZXN0cy4gWW91IHdpbGwgc2VlIHJlYWwgdGltZSBzdGF0cyBvZiB3aGF0IHBlcmZvcm1zIGJlc3QuIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2Itc29jaWFsLWFiIiwiZGVtb191cmwiOiJodHRwOlwvXC9zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvc29jaWFsLWFiXC8iLCJjaGVjayI6IkVTU0IzX0FCX1ZFUlNJT04iLCJ0YWdzIjoidW5pcXVlIiwiY2F0ZWdvcnkiOiJmdW5jdGlvbiIsInJlcXVpcmVzIjoiNC4wIiwiZmlsdGVycyI6ImZ1bmN0aW9uLGZyZWUifSwiZXNzYi1wb3N0LXZpZXdzIjp7InNsdWciOiJlc3NiLXBvc3Qtdmlld3MiLCJuYW1lIjoiUG9zdCBWaWV3cyBBZGQtb24gZm9yIEVhc3kgU29jaWFsIFNoYXJlIEJ1dHRvbnMiLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2V4dGVuc2lvbnMtMDUucG5nIiwiZGVzY3JpcHRpb24iOiJUcmFjayBhbmQgZGlzcGxheSBwb3N0IHZpZXdzXC9yZWFkcyB3aXRoIHlvdXIgc2hhcmUgYnV0dG9ucyBhbmQgYWxzbyBkaXNwbGF5IG1vc3QgcG9wdWxhciBwb3N0cyB3aXRoIHdpZGdldCBvciBzaG9ydGNvZGUuIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItcG9zdC12aWV3cyIsImRlbW9fdXJsIjoiaHR0cDpcL1wvc29jaWFsc2hhcmluZ3BsdWdpbi5jb21cL3ZpZXdzcmVhZHMtY291bnRlclwvIiwidGFncyI6InBvcHVsYXIiLCJjaGVjayI6IkVTU0IzX1BWX1ZFUlNJT04iLCJjYXRlZ29yeSI6ImZ1bmN0aW9uIiwicmVxdWlyZXMiOiIzLjAiLCJmaWx0ZXJzIjoiZnVjdGlvbixmcmVlIn0sImVzc2ItZmFjZWJvb2stY29tbWVudHMiOnsic2x1ZyI6ImVzc2ItZmFjZWJvb2stY29tbWVudHMiLCJuYW1lIjoiRmFjZWJvb2sgQ29tbWVudHMgQWRkLW9uIGZvciBFYXN5IFNvY2lhbCBTaGFyZSBCdXR0b25zIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA1LnBuZyIsImRlc2NyaXB0aW9uIjoiQXV0b21hdGljYWxseSBpbmNsdWRlIEZhY2Vib29rIGNvbW1lbnRzIHRvIHlvdXIgYmxvZyB3aXRoIG1vZGVyYXRpb24gb3B0aW9uIGJlbG93IHBvc3RzIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItZmFjZWJvb2stY29tbWVudHMiLCJkZW1vX3VybCI6Imh0dHA6XC9cL3NvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC9mYWNlYm9vay1jb21tZW50c1wvP2ZiY29tbWVudHNfZGVtbz10cnVlIiwiY2hlY2siOiJFU1NCM19GQ19WRVJTSU9OIiwidGFncyI6InBvcHVsYXIiLCJjYXRlZ29yeSI6ImZ1bmN0aW9uIiwicmVxdWlyZXMiOiIzLjAiLCJmaWx0ZXJzIjoiZnVuY3Rpb24sZnJlZSJ9LCJlc3NiLWFtcC1zdXBwb3J0Ijp7InNsdWciOiJlc3NiLWFtcC1zdXBwb3J0IiwibmFtZSI6IkFNUCBTaGFyZSBCdXR0b25zIEFkZC1vbiBmb3IgRWFzeSBTb2NpYWwgU2hhcmUgQnV0dG9ucyIsImltYWdlIjoiaHR0cDpcL1wvYWRkb25zLmFwcHNjcmVvLmNvbVwvaVwvZXh0ZW5zaW9ucy0wNS5wbmciLCJkZXNjcmlwdGlvbiI6IkluY2x1ZGUgc2hhcmUgYnV0dG9ucyBvbiB5b3VyIEFNUCBwYWdlcyBpZiB5b3UgdXNlIG9mZmljaWFsIHBsdWdpbiBXb3JkUHJlc3MgQU1QIiwicHJpY2UiOiJGUkVFIiwicGFnZSI6Imh0dHA6XC9cL2dldC5zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvP2Rvd25sb2FkPWVzc2ItYW1wLXN1cHBvcnQiLCJkZW1vX3VybCI6IiIsImNoZWNrIjoiRVNTQjNfQU1QX1BMVUdJTl9ST09UIiwidGFncyI6InVwZGF0ZWQiLCJjYXRlZ29yeSI6Im1vYmlsZSIsInJlcXVpcmVzIjoiNC4wIiwiZmlsdGVycyI6ImZ1bmN0aW9uLGZyZWUifSwiZXNzYi1vcHRpbi1jb250ZW50Ijp7InNsdWciOiJlc3NiLW9wdGluLWNvbnRlbnQiLCJuYW1lIjoiT3B0LWluIEZvcm1zIEJlbG93IENvbnRlbnQgQWRkLW9uIGZvciBFYXN5IFNvY2lhbCBTaGFyZSBCdXR0b25zIiwiaW1hZ2UiOiJodHRwOlwvXC9hZGRvbnMuYXBwc2NyZW8uY29tXC9pXC9leHRlbnNpb25zLTA0LnBuZyIsImRlc2NyaXB0aW9uIjoiQXV0b21hdGljYWxseSBpbmNsdWRlIG9wdC1pbiBmb3JtcyBmcm9tIEVhc3kgT3B0aW4gYmVsb3cgcG9zdCBjb250ZW50LiBFYXN5IGdldCBtb3JlIG5ldyBzdWJzY3JpYmVycyB0byB5b3VyIG1haWxpbmcgbGlzdC4iLCJwcmljZSI6IkZSRUUiLCJwYWdlIjoiaHR0cDpcL1wvZ2V0LnNvY2lhbHNoYXJpbmdwbHVnaW4uY29tXC8/ZG93bmxvYWQ9ZXNzYi1vcHRpbi1jb250ZW50IiwiZGVtb191cmwiOiJodHRwOlwvXC9zb2NpYWxzaGFyaW5ncGx1Z2luLmNvbVwvZWFzeS1vcHRpblwvIiwiY2hlY2siOiJFU1NCM19PRl9WRVJTSU9OIiwidGFncyI6IiIsImNhdGVnb3J5IjoiZmVhdHVyZSIsInJlcXVpcmVzIjoiNC4wIiwiZmlsdGVycyI6InN1YnNjcmliZSxmcmVlIn0sImhlbGxvLWZvbGxvd2VycyI6eyJzbHVnIjoiaGVsbG8tZm9sbG93ZXJzIiwibmFtZSI6IkhlbGxvIEZvbGxvd2VycyAtIFNvY2lhbCBDb3VudGVyIFBsdWdpbiIsImltYWdlIjoiaHR0cDpcL1wvYWRkb25zLmFwcHNjcmVvLmNvbVwvaVwvYWRkb25faW1hZ2VzNC0wNS5wbmciLCJkZXNjcmlwdGlvbiI6IkJlYXRpZnVsIGFuZCB1bmlxdWUgZXh0ZW5zaW9uIG9mIHlvdXIgY3VycmVudCBzb2NpYWwgZm9sbG93ZXJzIHdpdGggY292ZXIgYm94ZXMsIGxheW91dCBidWlsZGVyLCBhZHZhbmNlZCBjdXN0b21pemVyLCBwcm9maWxlIGFuYWx5dGljcy4gVHJ5IHRoZSBsaXZlIGRlbW8gdG8gdGVzdC4iLCJwcmljZSI6IiQyNCIsInBhZ2UiOiJodHRwOlwvXC9jb2RlY2FueW9uLm5ldFwvaXRlbVwvaGVsbG8tZm9sbG93ZXJzLXNvY2lhbC1jb3VudGVyLXBsdWdpbi1mb3Itd29yZHByZXNzXC8xNTgwMTcyOSIsImRlbW9fdXJsIjoiaHR0cDpcL1wvY29kZWNhbnlvbi5uZXRcL2l0ZW1cL2hlbGxvLWZvbGxvd2Vycy1zb2NpYWwtY291bnRlci1wbHVnaW4tZm9yLXdvcmRwcmVzc1wvZnVsbF9zY3JlZW5fcHJldmlld1wvMTU4MDE3MjkiLCJjaGVjayI6IkhGX1ZFUlNJT04iLCJjYXRlZ29yeSI6InBhaWQiLCJyZXF1aXJlcyI6IjEuMCIsImZpbHRlcnMiOiJwYWlkIn0sImVzc2Itc2VsZi1zaG9ydC11cmwiOnsic2x1ZyI6ImVzc2Itc2VsZi1zaG9ydC11cmwiLCJuYW1lIjoiU2VsZi1Ib3N0ZWQgU2hvcnQgVVJMcyBhZGQtb24gZm9yIEVhc3kgU29jaWFsIFNoYXJlIEJ1dHRvbnMiLCJpbWFnZSI6Imh0dHA6XC9cL2FkZG9ucy5hcHBzY3Jlby5jb21cL2lcL2FkZG9uX2ltYWdlczQtMDEucG5nIiwiZGVzY3JpcHRpb24iOiJHZW5lcmF0ZSBzZWxmIGhvc3RlZCBzaG9ydCBVUkxzIGRpcmVjdGx5IGZyb20geW91ciBXb3JkUHJlc3Mgd2l0aG91dCBleHRlcm5hbCBzZXJ2aWNlcyBsaWtlIGh0dHA6XC9cL2RvbWFpbi5jb21cL2F4V3NhIG9yIGN1c3RvbSBiYXNlZCBodHRwOlwvXC9kb21haW4uY29tXC9lc3NiLiIsInByaWNlIjoiJDE0IiwicGFnZSI6Imh0dHA6XC9cL2NvZGVjYW55b24ubmV0XC9pdGVtXC9zZWxmLWhvc3RlZC1zaG9ydC11cmxzLWFkZG9uLWZvci1lYXN5LXNvY2lhbC1zaGFyZS1idXR0b25zXC8xNTA2NjQ0NyIsImRlbW9fdXJsIjoiaHR0cDpcL1wvY29kZWNhbnlvbi5uZXRcL2l0ZW1cL3NlbGYtaG9zdGVkLXNob3J0LXVybHMtYWRkb24tZm9yLWVhc3ktc29jaWFsLXNoYXJlLWJ1dHRvbnNcL2Z1bGxfc2NyZWVuX3ByZXZpZXdcLzE1MDY2NDQ3IiwiY2hlY2siOiJFU1NCM19TU1VfVkVSU0lPTiIsImNhdGVnb3J5IjoicGFpZCIsInJlcXVpcmVzIjoiMy4xLjIiLCJmaWx0ZXJzIjoiZnVuY3Rpb24scGFpZCJ9LCJmaWx0ZXJzIjp7ImFsbCI6IkFsbCIsIm5ldyI6Ik5ldyIsImZyZWUiOiJGcmVlIiwibmV0d29ya3MiOiJOZXR3b3JrcyIsImRpc3BsYXkiOiJEaXNwbGF5IE1ldGhvZHMiLCJ0ZW1wbGF0ZSI6IlRlbXBsYXRlcyIsInN1YnNjcmliZSI6IlN1YnNjcmliZSBGb3JtcyIsInZpZGVvIjoiVmlkZW8gU2hhcmluZyIsImZ1bmN0aW9uIjoiRnVuY3Rpb25zIiwicGFpZCI6IlBhaWQiLCJpbnRlZ3JhdGlvbiI6IkludGVncmF0aW9uIiwid29vY29tbWVyY2UiOiJXb29Db21tZXJjZSJ9fQ==';
	private $base_addons_data;
	private $version5_exclude = array('essb-optin-flyout', 'essb-optin-booster', 'essb-optin-content', 'essb-amp-support');

	private static $instance = null;
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	} // end get_instance;

	function __construct() {
		$remote_result = base64_decode ( $this->base_addons );
		
		$remote_result = htmlspecialchars_decode ( $remote_result );
		$remote_result = stripslashes ( $remote_result );
		$info = json_decode($remote_result, true);
		$this->base_addons_data = $info;
	}


	public function call_remove_addon_list_update() {		
		$url = $this->update_addons_server;
		$result = wp_remote_get($url);
		$success_connection = true;

		if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
			$success_connection = false;
		}
			
		/* Check for incorrect data */
		if ($success_connection) {
			$remote_result = wp_remote_retrieve_body($result);
			$remote_result = base64_decode ( $remote_result );
		
			$remote_result = htmlspecialchars_decode ( $remote_result );
			$remote_result = stripslashes ( $remote_result );						
			
			$info = json_decode($remote_result, true);
			if (is_array($info)) {
				update_option($this->cache_options_slug, $info);
			}
		}
	}

	public function get_addons() {
		$addons = $this->base_addons_data;
		
		if (!is_array($addons)) {
			$addons = array();
		}
		
		$r = array();
		
		foreach ($addons as $key => $data) {
			if (!in_array($key, $this->version5_exclude)) {
				$r[$key] = $data;
			}
		}
		
		return $r;
	}

	public function get_new_addons() {
		$addons = $this->get_addons();

		if (!is_array($addons)) {
			$addons = array();
		}

		$current_announced = get_option($this->announced_addons_slug);
		if (!is_array($current_announced)) {
			$current_announced = array();
		}

		$list_of_new = array();
		foreach ($addons as $addon_key => $addon_data) {
			if ($addon_key == "filters") continue;
			
			if (in_array($addon_key, $this->version5_exclude)) continue;
			if (!isset($current_announced[$addon_key])) {
				$list_of_new[$addon_key] = array("title" => $addon_data['name'], "url" => $addon_data['page']);
			}
		}


		return $list_of_new;
	}

	public function get_new_addons_count() {

		$addons = $this->get_addons();

		if (!is_array($addons)) {
			$addons = array();
		}

		$current_announced = get_option($this->announced_addons_slug);
		if (!is_array($current_announced)) {
			$current_announced = array();
		}

		$list_of_new = 0;
		foreach ($addons as $addon_key => $addon_data) {
			if ($addon_key == "filters") continue;
			if (in_array($addon_key, $this->version5_exclude)) continue;
			if (!isset($current_announced[$addon_key])) {
				$list_of_new++;
			}
		}


		return $list_of_new;
	}

	public function dismiss_addon_notice($addon) {
		$current_announced = get_option($this->announced_addons_slug);
		if (!is_array($current_announced)) {
			$current_announced = array();
		}

		if (strpos($addon, ',') == false) {
			$current_announced[$addon] = "yes";
		}
		else {
			$addon_list = explode(',', $addon);
			foreach ($addon_list as $one) {
				$current_announced[$one] = "yes";
			}
		}

		update_option($this->announced_addons_slug, $current_announced, 'no');
	}
}

?>